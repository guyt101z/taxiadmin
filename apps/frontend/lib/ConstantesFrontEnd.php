<?php

class ConstantesFrontEnd {

    public static $CUENTA_CORREO_INFO_BYG = 'brunovierag@gmail.com';
    // public static $CUENTA_CORREO_INFO_BYG = 'skyredknight@gmail.com';

    public static $TIPO_USER_USUARIO = 'usuario';
    public static $TIPO_USER_ADMINISTRADOR = "administrador";

    public static $NAFTA = 'Nafta';
    public static $DIESEL = 'Diesel';

    public static $CONTADO = 'Contado';
    public static $CHEQUE = 'Cheque';
    public static $OTRO = 'Otro';
    
    public static $DIURNO = 'Diurno';
    public static $NOCTURNO = 'Nocturno';
    
    public static $GASTO_1 = 'Gas-Oil';
    public static $GASTO_2 = 'Aceite';
    public static $GASTO_3 = 'Gomería';
    public static $GASTO_4 = 'Lavado';
    public static $GASTO_5 = 'Viáticos';
    public static $GASTO_6 = 'Otros';
    
    public static $SIZE_WIDGET_FECHA = 10;
    public static $SIZE_WIDGET_COSTO = 8;
    public static $SIZE_WIDGET_KM = 3;
    public static $SIZE_WIDGET_RECAUDACION = 4;
    public static $SIZE_WIDGET_DESCRIPCION_COLS = 22;
    public static $SIZE_WIDGET_DESCRIPCION_COLS_DOS = 35;
    public static $SIZE_WIDGET_DESCRIPCION_ROWS = 6;
    public static $SIZE_WIDGET_DESCRIPCION_ROWS_MINI = 3;
    public static $SIZE_WIDGET_DIRECCION = 25;

    
    public static $CANTIDAD_DIAS_VENCIMIENTOS = 7;
    public static $CANTIDAD_MOVILES_PAGINADO = 15;
    public static $CANTIDAD_CHOFERES_PAGINADO = 15;
    public static $CANTIDAD_PROPIETARIOS_PAGINADO = 15;
    public static $CANTIDAD_EMPRESAS_PAGINADO = 15;
    public static $CANTIDAD_RECAUDACIONES_PAGINADO = 15;

    public static $VALOR_LIBRETA_DE_CONDUCIR = 1570.00;
    public static $VALOR_CARNE_DE_SALUD = 983.00;
    
    public static $FORMAT_DATE = 'd/m/Y';

    public static function getRangoAnios() {
        return range(2010, 2020);
    }

    public static function getDetalleGasto($gasto){
        $detalle = '';
        switch ($gasto) {
            case '1':
                $detalle = EtiquetasFrontEnd::$GASTO_1;
            break;
            case '2':
                $detalle = EtiquetasFrontEnd::$GASTO_2;
            break;
            case '3':
                $detalle = EtiquetasFrontEnd::$GASTO_3;
            break;
            case '4':
                $detalle = EtiquetasFrontEnd::$GASTO_4;
            break;

            case '5':
                $detalle = EtiquetasFrontEnd::$GASTO_5;
            break;
            case '6':
                $detalle = EtiquetasFrontEnd::$GASTO_6;
            break;

        }
        return $detalle;
    }

}