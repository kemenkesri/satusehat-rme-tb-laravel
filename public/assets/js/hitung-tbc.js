var tbcJawaban = []

$('input[name=batuk_terus]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        tbcJawaban.push(1)
    }else{
        removeTBC(tbcJawaban,1)
    }
    hitungTBC(tbcJawaban)
})
$('input[name=demam_lebihdari_2minggu]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        tbcJawaban.push(2)
    }else{
        removeTBC(tbcJawaban,2)
    }
    hitungTBC(tbcJawaban)
})
$('input[name=bb_tidak_naik_turun]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        tbcJawaban.push(3)
    }else{
        removeTBC(tbcJawaban,3)
    }
    hitungTBC(tbcJawaban)
})
$('input[name=kontak_erat_dg_pasien_tbc]').change(function () {  
    let jawaban = $(this).val()
    if(jawaban == 'iya'){
        tbcJawaban.push(4)
    }else{
        removeTBC(tbcJawaban,4)
    }
    hitungTBC(tbcJawaban)
})

function removeTBC(array,number) {
    const index = array.indexOf(number);
    if (index > -1) {
        array.splice(index, 1);
    }
}

function hitungTBC(params) {
    let hasilTBC = params.length
    if(hasilTBC < 2){
        $('#skor_tbc').val(hasilTBC+' (TIDAK BERESIKO)')
    }else if(hasilTBC >= 2){
        $('#skor_tbc').val(hasilTBC+' (BERESIKO)')
    }else{
        $('#skor_tbc').val(hasilTBC+' (TIDAK BERESIKO)')
    }
}