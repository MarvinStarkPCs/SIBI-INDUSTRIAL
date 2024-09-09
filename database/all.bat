@echo off

REM Configuración de las variables
set DB_HOST=localhost
set DB_USER=root
set DB_PASSWORD=
set DB_NAME=sibi

REM Archivos SQL a ejecutar
set SQL_FILES=create_tables.sql indexes.sql constraints.sql inserts.sql

REM Función para ejecutar cada archivo SQL
for %%f in (%SQL_FILES%) do (
    echo ================================
    echo Ejecutando archivo: %%f
    echo ================================
    mysql -h %DB_HOST% -u %DB_USER% -p%DB_PASSWORD% --default-character-set=utf8mb4 %DB_NAME% < "%%f"

    if errorlevel 1 (
        echo Error al ejecutar %%f.
        exit /b 1
    ) else (
        echo %%f ejecutado correctamente.
    )
)

echo Todos los archivos SQL se han ejecutado correctamente.
pause
