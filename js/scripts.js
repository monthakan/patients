
function all() // ฟังก์ชันเปิดมาหน้าแรกแล้วเจอเลย
{
    $.ajax({
        type: "GET", //using GET method to get all record ส่งผ่าน url
        url: 'all.php', //ใช้กับไฟล์นี้
        success: function(response){ //ถ้าทำงานสำเร็จให้ส่งผลลัพธ์กลับมาที่
           //แสดงผลลัพธ์
            response = JSON.parse(response);

            var html ="";

            if(response.length){
                html += '<div class="list-group">';
                //Loop
                $.each(response, function(key,value){
                // แสดงผล list template เมื่อมีการบันทึกผู้ป่วย
                    html +='<a href="#" class="list-group-item list-group-item-action">';
                    html += "<p>"+ " <span class='list-email'>(" + value.sample + ")</span>"+ ' '+value.title+ ' ' + value.first_name+' '+ value.surname + "</p>";
                    html += "<p>" + value.age + ' ' + value.tel + "</p>";
                    html += "<p class='list-address'>" + value.source + "</p>";
                    html += "<button class='btn btn-sm btn-primary mt-2' data-toggle='modal' data-target='#edit-employee-modal' data-id='"+value.id+"'>Edit</button>";
                    html += "<button class='btn btn-sm btn-danger mt-2 ml-2 btn-delete-employee' data-id='"+value.id+"' typle='button'>Delete</button>";
                    html += '</a>';
                });
                html += '</div>';
            }else{
                html += '<div class="alert alert-warning">';
                html += 'No records found!';
                html += '</div>';
            }
            // นำเข้าหน้า html และแสดงผลข้อมูลผู้ป่วยทั้งหมด
            $("#employees-list").html(html);
        }
    })
}

function save()
{
    $("#btnSubmit").on("click", function(){
        var $this           = $(this); //เมื่อกด submit จะรัน ID ให้เองอัตโนมัติ
        var $caption        = $this.html(); //html รันหน้าใหม่มาเมื่อกด submit
        var form            = "#form"; // กำหนด #form ID
        var formData        = $(form).serializeArray(); //array
        var route           = $(form).attr('action'); //เรียกใช้ attribute actionในไฟล์ html



        //เรียกใช้ Ajax
        $.ajax({
            type : "POST", // ส่งผ่านฟอร์มและส่งข้อมูลมาก
            url: route, // ส่งค่าไป route (mysql)
            data : formData, // แบบฟอร์มที่เราสร้าง
            beforeSend: function () { // ใช้ฟังก์ชันนี้เพื่อป้องกันการคลิกส่งหลายครั้ง (ส่งซ้ำ อะไรประมาณนี้)
                $this.attr('disable', true).html("Processing");
            },
            success: function (response) {
                $this.attr('disabled', false).html($caption);
                // reload lists
                all();
                // สร้างการแสดงผลผลลัพธ์โดยใช้ alert
                Swal.fire({
                    icon: 'success',
                    title: 'Succcess.',
                    text : response
                });

                //reset form เพื่อให้มันกลับมาหน้าใหม่แบบว่างเปล่า จะได้ง่ายต่อการใช้งาน
                resetForm(form);
            },
            error: function (XMLHttpRequst, textStatus, errorThrown){
            //ถ้ามันขึ้น error จะให้แสดงผลอะไรอันนี้แล้วแต่เรา
            }
        });
    });
}


function resetForm(selector)
{
    $selector[0].reset();
}

function get() //edit
{
    $(document).delegate("[data-target='#edit-employee-modal']", "click", function(){
        var patientsID =$(this).attr('data=id');

        // เรียกใช้ Ajax
        $.ajax({
            type: "GET",
            url: 'get.php',
            data: {patients_id:patientsID},
            beforeSend: function(){

            },
            success: function(response){//เมื่อประมวลผลเสร็จแล้วให้แสดงผลต่อตามคำสั่งนี้
                response = JSON.parse(response);
                $("#edit-form [name=\"id\"]").val(response.id);
                $("#edit-form [name=\"sample\"]");
                $("#edit-form [name=\"title\"]");
                $("#edit-form [name=\"first_name\"]");
                $("#edit-form [name=\"surname\"]");
                $("#edit-form [name=\"age\"]");
                $("#edit-form [name=\"ocdr\"]");
                $("#edit-form [name=\"mmse\"]");
                $("#edit-form [name=\"blood_collection\"]");
                $("#edit-form [name=\"report_date\"]");
                $("#edit-form [name=\"source\"]");
                $("#edit-form [name=\"tel\"]");
                $("#edit-form [name=\"teltwo\"]");
                $("#edit-form [name=\"line\"]");
                $("#edit-form [name=\"creation_date\"]");
            }
        });
    });
}

function update()
{
    $("#btnUpdateSubmit").on("click", function(){
        var $this           = $(this); //เมื่อกด submit จะรัน ID ให้เองอัตโนมัติ
        var $caption        = $this.html(); //html รันหน้าใหม่มาเมื่อกด submit
        var form            = "#edit-form"; // กำหนด #editform ID
        var formData        = $(form).serializeArray(); //array
        var route           = $(form).attr('action'); //เรียกใช้ attribute actionในไฟล์ html


        //เรียกใช้ Ajax
        $.ajax({
            type: "POST",
            url: route,
            data: formData,
            beforeSend: function(){
                $this.attr('disabled', true).html("Processing...");
            },
            success: function (response){
                $this.attr('disabled', false).html($caption);
                //reload
                all();

                Swal.fire({
                    icon: 'success',
                    title: 'Success.',
                    text: response
                });

                // reset form
                resetForm(form);

                //close madal
                $('#edit-employee-modal').modal('toggle');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown){

            }
        });
    });
}

function del()
{
    $(document).delegate(".btn-delete-employee", "click", function() {

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result)=>{

           if(result.isConfirmed){
            var patientsID = $(this).attr('data-id');

            $.ajax({
                type: "GET",
                url: 'delete.php',
                data: {patients_id:patientsID},
                beforeSend: function(){

                },
                success: function(){

                    all();

                    Swal.fire('Success.', response, 'success')
                }
            });

           }else if(result.isDenied){
            Swal.fire('Changes are not saved', '', 'info')
           }
        });


    });
}

$(document).ready(function(){
    //แสดงหน้าหลัก
    all();
    //กดปุ่ม submit โดยใช้ AJAX บันทึกข้อมูล
    save();
    //Get the data and view to modal
    get();
    // Updating the data
    update();
    // Delete record via ajax
    del();
});