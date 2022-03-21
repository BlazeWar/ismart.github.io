$(document).ready(function() {
    $(".num_order").change(function() {
        var id = $(this).attr('data-id');
        var qty = $(this).val();
        var data = { id: id, qty: qty };
        // console.log(data);

        $.ajax({
            url: '?mod=cart&action=updateajax', //Trang xử lý, mặc định trang hiện tại
            method: 'POST', // Post hoặc Get, mặc định Get
            data: data, // Truyền dữ liệu lên sever
            dataType: 'json', // html,text,script hoặc json
            success: function(data) {
                $("#sub-total-" + id).text(data.sub_total);
                $("#total-price span").text(data.total);
                console.log(data);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }

        });
    });
});

// Cách xử lý lỗi
// 404 đường dẫn không tồn tại
// error: function(xhr, ajaxOptions, thrownError) {
//     alert(xhr.status);
//     alert(thrownError);
// };