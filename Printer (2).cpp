#include <iostream>
#include <string>
#include <windows.h>
#include <winspool.h>
#include <fstream>
#include <shellapi.h>

// ...


using namespace std;

bool PrintPDF(const wstring& printerName, const wstring& pdfFileName, const wstring& paperSize, int copies) {
    HANDLE hPrinter;

    wchar_t printerNameCopy[256];
    wcscpy_s(printerNameCopy, printerName.c_str());

    if (!OpenPrinterW(printerNameCopy, &hPrinter, NULL)) {
        wcerr << L"Ошибка открытия принтера: " << GetLastError() << endl;
        return false;
    }

    LONG devModeSize = DocumentPropertiesW(NULL, hPrinter,
        printerNameCopy,
        NULL, NULL, 0);
    if (devModeSize < 0) {
        wcerr << L"Ошибка получения размера DEVMODE" << endl;
        ClosePrinter(hPrinter);
        return false;
    }

    PDEVMODEW devMode = (PDEVMODEW)malloc(devModeSize);
    if (!devMode) {
        wcerr << L"Ошибка выделения памяти" << endl;
        ClosePrinter(hPrinter);
        return false;
    }

    if (DocumentPropertiesW(NULL, hPrinter,
        printerNameCopy,
        devMode, NULL, DM_OUT_BUFFER) != IDOK) {
        wcerr << L"Ошибка получения настроек принтера" << endl;
        free(devMode);
        ClosePrinter(hPrinter);
        return false;
    }

    // Настройка размера бумаги
    wcscpy_s(devMode->dmFormName, paperSize.c_str());
    devMode->dmFields |= DM_FORMNAME;

    // Настройка количества копий
    if (copies > 1) {
        devMode->dmCopies = copies;
        devMode->dmFields |= DM_COPIES;
    }

    if (DocumentPropertiesW(NULL, hPrinter,
        printerNameCopy,
        devMode, devMode,
        DM_IN_BUFFER | DM_OUT_BUFFER) != IDOK) {
        wcerr << L"Ошибка применения настроек" << endl;
        free(devMode);
        ClosePrinter(hPrinter);
        return false;
    }

    wchar_t docName[256];
    wchar_t dataType[] = L"RAW";

    wcscpy_s(docName, pdfFileName.c_str());

    DOC_INFO_1W docInfo;
    docInfo.pDocName = docName;
    docInfo.pOutputFile = NULL;
    docInfo.pDatatype = dataType;

    DWORD jobID = StartDocPrinterW(hPrinter, 1, (LPBYTE)&docInfo);
    if (jobID == 0) {
        wcerr << L"Ошибка начала задания печати: " << GetLastError() << endl;
        free(devMode);
        ClosePrinter(hPrinter);
        return false;
    }

    ifstream pdfFile(pdfFileName, ios::binary);
    if (!pdfFile) {
        wcerr << L"Ошибка открытия файла PDF" << endl;
        free(devMode);
        EndDocPrinter(hPrinter);
        ClosePrinter(hPrinter);
        return false;
    }

    StartPagePrinter(hPrinter);

    const size_t bufferSize = 32768;
    char buffer[bufferSize];
    while (pdfFile.read(buffer, bufferSize) || pdfFile.gcount()) {
        DWORD bytesWritten;
        if (!WritePrinter(hPrinter, buffer, (DWORD)pdfFile.gcount(), &bytesWritten)) {
            wcerr << L"Ошибка записи на принтер: " << GetLastError() << endl;
            free(devMode);
            EndPagePrinter(hPrinter);
            EndDocPrinter(hPrinter);
            ClosePrinter(hPrinter);
            return false;
        }
    }

    EndPagePrinter(hPrinter);
    EndDocPrinter(hPrinter);
    ClosePrinter(hPrinter);
    free(devMode);

    return true;
}
bool FileExists(const wstring& filename) {
    ifstream file(filename, ios::binary);
    return file.good();
}
void ListPrinters() {
    DWORD needed = 0, returned = 0;

    EnumPrintersW(PRINTER_ENUM_LOCAL | PRINTER_ENUM_CONNECTIONS,
        NULL,
        2,
        NULL,
        0,
        &needed,
        &returned);

    if (needed == 0) {
        wcerr << L"Не удалось определить размер буфера для принтеров" << endl;
        return;
    }

    BYTE* buffer = new BYTE[needed];

    if (!EnumPrintersW(PRINTER_ENUM_LOCAL | PRINTER_ENUM_CONNECTIONS,
        NULL,
        2,
        buffer,
        needed,
        &needed,
        &returned)) {
        wcerr << L"Ошибка получения списка принтеров: " << GetLastError() << endl;
        delete[] buffer;
        return;
    }

    PRINTER_INFO_2W* printers = (PRINTER_INFO_2W*)buffer;
    wcout << L"\nДоступные принтеры:" << endl;
    for (DWORD i = 0; i < returned; i++) {
        wcout << L" - " << printers[i].pPrinterName << endl;
    }

    delete[] buffer;
}
int main() {
    _wsetlocale(LC_ALL, L"Russian");

    wcout << L"=== Программа печати PDF ===" << endl;

    wstring pdfFileName;
    wcout << L"Введите полный путь к PDF файлу: ";
    getline(wcin, pdfFileName);

    if (!FileExists(pdfFileName)) {
        wcerr << L"Ошибка: файл не существует!" << endl;
        return 1;
    }

    ListPrinters();

    wstring printerName;
    wcout << L"\nВведите имя принтера: ";
    getline(wcin, printerName);

    wstring paperSize;
    wcout << L"Введите размер бумаги (Letter, A4, Legal и т.д.): ";
    getline(wcin, paperSize);

    int copies = 1;
    wcout << L"Введите количество копий (по умолчанию 1): ";
    wstring copiesStr;
    getline(wcin, copiesStr);
    if (!copiesStr.empty()) {
        try {
            copies = stoi(copiesStr);
            if (copies < 1 || copies > 999) { // ограничение на случай ошибки
                wcerr << L"Количество копий должно быть от 1 до 999." << endl;
                return 1;
            }
        }
        catch (...) {
            wcerr << L"Неверное значение количества копий." << endl;
            return 1;
        }
    }
    ShellExecuteW(NULL, L"print", pdfFileName.c_str(), L"", NULL, SW_HIDE);
}