var skilasJawaban = []

$('input[name=orientasi_waktu_tempat]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=mengulang_ketiga_kata]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=berdiri_dari_kursi]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=bb_berkurang]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=hilang_nafsu_makan]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=lila_kurang_dari_duasatu]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=masalah_pada_mata]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=tes_melihat]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=tes_berbisik]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=perasaan_sedih]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})
$('input[name=sedikit_minat_aktifitas]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        skilasJawaban.push(1)
    }else{
        skilasJawaban.shift()
    }
    hitungSkilas(skilasJawaban)
})

function hitungSkilas(params) {
    let hasilTBC = 0;
    if($('input[name=orientasi_waktu_tempat]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=mengulang_ketiga_kata]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=berdiri_dari_kursi]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=bb_berkurang]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=hilang_nafsu_makan]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=lila_kurang_dari_duasatu]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=masalah_pada_mata]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=tes_melihat]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=tes_berbisik]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=perasaan_sedih]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if($('input[name=sedikit_minat_aktifitas]').filter(":checked").val() == 'iya'){
        hasilTBC += 1;
    }
    if(hasilTBC < 1){
        $('#nilai_akhir').val(hasilTBC+' (Normal)')
    }else{
        $('#nilai_akhir').val(hasilTBC+' (Abnormal/Rujuk)')
    }
}