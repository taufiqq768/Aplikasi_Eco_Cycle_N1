<?php
namespace App;

enum KodeUnitEnum: string
{


    case K8F01 = 'PKS Luwu';

    case K7F19 = 'PKS KERTAJAYA';
    case K7F16 = 'PABRIK KETAHUN';
    case K7F15 = 'PABRIK PADANG PELAWI';
    case K7F14 = 'PABRIK TALOPINO';
    case K7F13 = 'PABRIK BATURAJA';
    case K7F12 = 'PABRIK BERINGIN';
    case K7F11 = 'PABRIK TEBENAN';
    case K7F10 = 'PABRIK MUSILANDAS';
    case K7F09 = 'PABRIK SUNGAI NIRU';
    case K7F08 = 'PABRIK SUNGAI LENGI';
    case K7F07 = 'PABRIK TALANG SAWIT';
    case K7F06 = 'PABRIK BETUNG';
    case K7F05 = 'PABRIK TULUNG BUYUT';
    case K7F04 = 'PABRIK PEMATANG KIWAH';
    case K7F03 = 'PABRIK KEDATON';
    case K7F02 = 'PABRIK WAY BERULU';
    case K7F01 = 'PABRIK BEKRI';

    case K6F07 = 'PKS COT GIREK';
    case K6F06 = 'PKS TANJUNG SEUMANTOH';
    case K6F05 = 'PKS PULAU TIGA';
    case K6F04 = 'PKS PAGAR MERBAU';
    case K6F03 = 'PKS SAWIT SEBERANG';
    case K6F02 = 'PKS SAWIT HULU';
    case K6F01 = 'PKS KWALA SAWIT';

    case K5FKS = 'PKR Tambaranga';
    case K5F22 = 'PKS Longpinang';
    case K5F21 = 'PKS Samuntai';
    case K5F1A = 'Proyek Batubar';
    case K5F15 = 'PKS Pelaihari';
    case K5F14 = 'PKS Pamukan';
    case K5F09 = 'PKS Kembayan';
    case K5F08 = 'PKS Parindu';
    case K5F07 = 'PKS Ngabang';
    case K5F04 = 'PKS RimbaBelia';
    case K5F01 = 'PKS Gn. Meliau';

    case K5E21 = 'Kb Raren Batua';
    case K5E1A = 'Plasma Kalbar';
    case K5E19 = 'Kb Longkali';
    case K5E18 = 'Kb Pandawa Int';
    case K5E17 = 'Kb Tajati';
    case K5E16 = 'Kb Tabara';
    case K5E15 = 'Kb Pelaihari';
    case K5E14 = 'Kb Pamukan';
    case K5E13 = 'Kb Batulicin';
    case K5E12 = 'Kb Kumai';
    case K5E11 = 'Kb Danau Salak';
    case K5E09 = 'Kb Kembayan';
    case K5E08 = 'Kb Parindu';
    case K5E07 = 'Kb Ngabang';
    case K5E06 = 'Kb Sintang';
    case K5E04 = 'Kb Rimba Belia';
    case K5E03 = 'Kb Sungai Dekan';
    case K5E02 = 'Kb Gunung Emas';
    case K5E01 = 'Kb Gn. Meliau';

    case K4R00 = 'Kantor Pusat PTPN VI';

    case K4F14 = 'Pabrik Sungai Bahar';
    case K4F13 = 'Pabrik Teh Kemasan';
    case K4F12 = 'Integrasi Sawit Sapi';
    case K4F11 = 'Pabrik Pengabuan';
    case K4F10 = 'Pabrik Crumb Rubber';
    case K4F09 = 'Pabrik Danau Kembar';
    case K4F08 = 'Pabrik Kayu Aro';
    case K4F07 = 'Pabrik Ophir';
    case K4F06 = 'Pabrik Solok Selatan';
    case K4F05 = 'Pabrik Rimbo Dua';
    case K4F04 = 'Pabrik Tanjung Lebar';
    case K4F03 = 'Pabrik Bunut';
    case K4F02 = 'Pabrik Pinang tinggi';
    case K4F01 = 'Pabrik Aurgading';

    case K4E15 = 'Kebun Lagan';
    case K4E14 = 'KB BUKIT KAUSA';
    case K4E12 = 'Kebun Tanjung Lebar';
    case K4E11 = 'Kebun Solok Selatan';
    case K4E10 = 'Kebun Rimbo Satu';
    case K4E09 = 'Kebun Rimbo Bujang Dua';
    case K4E08 = 'Kebun Pangkalan Lima Puluh Kot';
    case K4E07 = 'Kebun Ophir';
    case K4E06 = 'Kebun Kayu Aro';
    case K4E05 = 'Kebun Durian Luncuk';
    case K4E04 = 'Kebun Danau Kembar';
    case K4E03 = 'Kebun Bunut';
    case K4E02 = 'Kebun Bukit Cermin';
    case K4E01 = 'Kebun Batang Hari';

    case K3R00 = 'Kantor Pusat PTPN V';

    case K3F15 = 'Pb. PPKR Bukit Selasih';
    case K3F14 = 'Pb. PKR SEI Lindai';
    case K3F13 = 'Pb. PKO Tandun';
    case K3F12 = 'Pb. SEI Intan';
    case K3F11 = 'Pb. SEI Rokan';
    case K3F10 = 'Pb. SEI Tapung';
    case K3F09 = 'Pb. Terantam';
    case K3F08 = 'Pb. Tandun';
    case K3F07 = 'Pb. Lubuk Dalam';
    case K3F06 = 'Pb. SEI Buatan';
    case K3F05 = 'Pb. SEI Garo';
    case K3F04 = 'Pb. SEI Pagar';
    case K3F03 = 'Pb. SEI Galuh';
    case K3F02 = 'Pb. Tanjung Medan';
    case K3F01 = 'Pb. Tanah Putih';

    case K3E25 = 'Kb Pls/Pbelian STA/SSI/SIN/SRO';
    case K3E24 = 'Kb Sei Berlian';
    case K3E23 = 'Kb Inti / KKPA Sei Tapung';
    case K3E22 = 'Kb Sei Siasam';
    case K3E21 = 'Kb Inti Sei Intan';
    case K3E20 = 'Kb Sei Rokan';
    case K3E18 = 'Kb Inti/KKPA Sei Batu Langkah';
    case K3E17 = 'Kb Tamora';
    case K3E16 = 'Kb Sei Lindai';
    case K3E15 = 'Kb Sei Kencana';
    case K3E14 = 'Kb Terantam';
    case K3E13 = 'Kb Tandun';
    case K3E12 = 'Kb Pls/Pbelian SBT/LDA';
    case K3E11 = 'Kb Inti/KKPA Air Molek II';
    case K3E10 = 'Kb Inti/KKPA Air Molek I';
    case K3E09 = 'Kb Inti Sei Buatan';
    case K3E08 = 'Kb Inti Lubuk Dalam';
    case K3E07 = 'Kb Pls/Pbelian TPU/TME';
    case K3E06 = 'Kb Pls/Pbelian SGO/SPA/SGH';
    case K3E05 = 'Kb Inti Tanah Putih';
    case K3E04 = 'Kb Tanjung Medan';
    case K3E03 = 'Kb Inti/KKPA Sei Pagar';
    case K3E02 = 'Kb Inti/KKPA Sei Garo';
    case K3E01 = 'Kb Inti/KKPA Sei Galuh';

    case K2R00 = 'Kantor Pusat PTPN IV';

    case K2F21 = 'Pb. Mesin Tenera Dolok Ilir';
    case K2F20 = 'Pb. Pgolahan Inti Sawit Timur';
    case K2F19 = 'Pb. Pgolahan Inti Sawit Pabatu';
    case K2F18 = 'Pb. Sosa';
    case K2F17 = 'Pb. Ajamu';
    case K2F16 = 'Pb. Berangir';
    case K2F15 = 'Pb. Pulu Raja';
    case K2F14 = 'Pb. Air Batu';
    case K2F13 = 'Pb. Tinjowan';
    case K2F12 = 'Pb. Timur';
    case K2F11 = 'Pb. Sawit Langkat';
    case K2F10 = 'Pb. Pabatu';
    case K2F09 = 'Pb. Adolina';
    case K2F08 = 'Pb. Teh Tobasari';
    case K2F07 = 'Pb. Teh Bah Butong';
    case K2F06 = 'Pb. Mayang';
    case K2F05 = 'Pb. Gunung Bayu';
    case K2F04 = 'Pb. Dolok Ilir';
    case K2F03 = 'Pb. Dolok Sinumbah';
    case K2F02 = 'Pb. Pasir Mandoge';
    case K2F01 = 'Pb. Bah Jambi';

    case K2E33 = 'Kebun Benih Adolina';
    case K2E32 = 'Kb. Meranti Paham';
    case K2E31 = 'Kb. Panai Jaya';
    case K2E30 = 'Kb. Sosa';
    case K2E29 = 'Kb. Ajamu';
    case K2E28 = 'Kb. Berangir';
    case K2E27 = 'Kb. Pulu Raja';
    case K2E26 = 'Kb. Air Batu';
    case K2E25 = 'Kb. Plasma Madina';
    case K2E24 = 'Kb. Batang Laping';
    case K2E23 = 'Kb. Aek Nauli';
    case K2E22 = 'Kb. Padang Matinggi';
    case K2E21 = 'Kb. Tinjowan';
    case K2E20 = 'Kb. Timur';
    case K2E19 = 'Kb. Sawit Langkat';
    case K2E18 = 'Kb. Pabatu';
    case K2E17 = 'Kb. Adolina';
    case K2E16 = 'Kb. Teh';
    case K2E15 = 'Kb. Tanah Itam Ulu';
    case K2E14 = 'Kb. Bukit Lima';
    case K2E13 = 'Kb. Laras';
    case K2E12 = 'Kb. Mayang';
    case K2E11 = 'Kb. Gunung Bayu';
    case K2E10 = 'Kb. Dolok Ilir';
    case K2E09 = 'Kb. Balimbingan';
    case K2E08 = 'Kb. Bah Birung Ulu';
    case K2E07 = 'Kb. Marjandi';
    case K2E06 = 'Kb. Sei Kopas';
    case K2E05 = 'Kb. Tonduhan';
    case K2E04 = 'Kb. Marihat';
    case K2E03 = 'Kb. Dolok Sinumbah';
    case K2E02 = 'Kb. Pasir Mandoge';
    case K2E01 = 'Kb. Bah Jambi';

    case K1R00 = 'KANTOR PUSAT PTPN III';

    case K1F25 = 'PABRIK KELAPA SAWIT CIKASUNGKA';
    case K1F23 = 'PABRIK PENGOLAHAN KARET RAMBUTAN';
    case K1F22 = 'PABRIK PENGOLAHAN KARET HAPESONG';
    case K1F21 = 'PABRIK PENGOLAHAN KARET SARANG GITING';
    case K1F20 = 'PABRIK PENGOLAHAN KARET GUNUNG PARA';
    case K1F19 = 'PABRIK PENGOLAHAN KARET BANDAR BETSY';
    case K1F18 = 'PABRIK PENGOLAHAN KARET SEI SILAU';
    case K1F17 = 'PABRIK PENGOLAHAN KARET MEMBANG MUDA';
    case K1F16 = 'PABRIK PENGOLAHAN KARET RANTAU PRAPAT';
    case K1F15 = 'KAWASAN INDUSTRI SEI MANGKEI';
    case K1F14 = 'PEMBANGKIT LISTRIK TENAGA BIOMASS SEI MANGKEI';
    case K1F13 = 'PABRIK KERNEL SEI MANGKEI';
    case K1F12 = 'PABRIK KELAPA SAWIT HAPESONG';
    case K1F11 = 'PABRIK KELAPA SAWIT RAMBUTAN';
    case K1F10 = 'PABRIK KELAPA SAWIT SEI MANGKEI';
    case K1F09 = 'PABRIK KELAPA SAWIT SEI SILAU';
    case K1F08 = 'PABRIK KELAPA SAWIT AEK NABARA SELATAN';
    case K1F07 = 'PABRIK KELAPA SAWIT SISUMUT';
    case K1F06 = 'PABRIK KELAPA SAWIT AEK RASO';
    case K1F05 = 'PABRIK KELAPA SAWIT AEK TOROP';
    case K1F04 = 'PABRIK KELAPA SAWIT SEI BARUHUR';
    case K1F03 = 'PABRIK KELAPA SAWIT TORGAMBA';
    case K1F02 = 'PABRIK KELAPA SAWIT SEI DAUN';
    case K1F01 = 'PABRIK KELAPA SAWIT SEI MERANTI';

    case K1E43 = 'KBN KERTAJAYA';
    case K1E42 = 'KBN SUKAMAJU';
    case K1E41 = 'KBN CIKASUNGKA';
    case K1E40 = 'KBN CISALAK BARU';
    case K1E39 = 'KBN BOJONGDATAR';
    case K1E38 = 'KBN TJIBUNGUR';
    case K1E37 = 'KBN PANGLEJAR';
    case K1E36 = 'KEBUN JULOK RAYEU SELATAN';
    case K1E35 = 'KEBUN KARANG INONG';
    case K1E34 = 'KEBUN BATANG TORU';
    case K1E33 = 'KEBUN HAPESONG';
    case K1E32 = 'KEBUN RAMBUTAN';
    case K1E31 = 'KEBUN TANAH RAJA';
    case K1E30 = 'KEBUN SARANG GITING';
    case K1E29 = 'KEBUN SEI PUTIH';
    case K1E28 = 'KEBUN GUNUNG PARA';
    case K1E27 = 'KEBUN SILAU DUNIA';
    case K1E26 = 'KEBUN GUNUNG MONACO';
    case K1E25 = 'KEBUN GUNUNG PAMELA';
    case K1E24 = 'KEBUN BANGUN';
    case K1E23 = 'KEBUN BANDAR BETSY';
    case K1E22 = 'KEBUN DUSUN HULU';
    case K1E21 = 'KEBUN BANDAR SELAMAT';
    case K1E20 = 'KEBUN HUTA PADANG';
    case K1E19 = 'KEBUN SEI SILAU';
    case K1E18 = 'KEBUN AMBALUTU';
    case K1E17 = 'KEBUN PULAU MANDI';
    case K1E16 = 'KEBUN SEI DADAP';
    case K1E15 = 'KEBUN MERBAU SELATAN';
    case K1E14 = 'KEBUN LABUHAN HAJI';
    case K1E13 = 'KEBUN MEMBANG MUDA';
    case K1E12 = 'KEBUN RANTU PRAPAT';
    case K1E11 = 'KEBUN AEK NABARA SELATAN';
    case K1E10 = 'KEBUN AEK NABARA UTARA';
    case K1E09 = 'KEBUN SISUMUT';
    case K1E08 = 'KEBUN PIR AEK RASO';
    case K1E07 = 'KEBUN AEK TOROP';
    case K1E06 = 'KEBUN SEI KEBARA';
    case K1E05 = 'KEBUN SEI BARUHUR';
    case K1E04 = 'KEBUN BUKIT TUJUH';
    case K1E03 = 'KEBUN TORGAMBA';
    case K1E02 = 'KEBUN SEI DAUN';
    case K1E01 = 'KEBUN SEI MERANTI';

    public static function fromOrDefault(string $value): string
    {
        return self::tryFrom($value)?->value ?? 'Bukan Unit';
    }
}