/**
 * Created by Администратор on 09.11.15.
 * Валидация введенных данных на стороне сервера без перезагрузки в форме регистрации оборудования
 */
$(document).ready(function(){
    //активируем подсказки Bootstrap
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    var formOk;

    //перед отправкой запрашиваем у сервера корректность введенных полей
    //если поля не корректны - кидаем сообщение в модали и выделяем неправильное поле
    $("#sendForm").click(function(){
        var msg   = $('#regForm').serialize();
        $.ajax({
            type: 'POST',
            url:'/dealer/checkDevForm',
            dataType: 'json',
            data: msg,
            success: function(data) {
                if (!data.err){
                    $("#regForm").find("[name]").each(function(indx, element){
                        //проверка отмечен ли инпут как ошибочный
                        var checkInput = new CheckInput($(element), $(element).parent(), data.fild);
                        checkInput.checkWrong();
                    });
                    //alert(data.text);
                    $('#errorText').text(data.text);
                    $('#errorModal').modal();
                    //return false;
                }
                else {
                    $("#regForm").submit();
                }
                //alert(data.err + " , " + data.text + " , " + data.fild);
                //$('.results').html(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;
    });


    function CheckInput(inputElement, inputDiv, wrongFild){
        //метод проверяет отмечен ли класс инпута как содержащий ошибку. Если отмечен и поле уже не ошибочно - устанавливает класс правильного поля
        this.checkWrong = function(){
            if (inputElement.attr("name") != wrongFild & inputDiv.hasClass("has-error")) {
                inputDiv.removeClass().addClass("input-group has-success");
            }
            else if (inputElement.attr("name") == wrongFild) {
                inputDiv.removeClass().addClass("input-group has-error");
            }
        };
        //проверка на наличие пиктограммы и тип пиктограммы.
        //метод добавляет к инпуту пиктограмму ошибки или ОК
        this.checkSpan = function(){

            if (inputDiv.find("span").length){
                if (inputDiv.hasClass('has-error')){
                    inputDiv.find('span').removeClass().addClass('glyphicon glyphicon-remove form-control-feedback');
                }
                else {
                    inputDiv.find('span').removeClass().addClass('glyphicon glyphicon-ok form-control-feedback');
                }
            }
            else {
                if (inputDiv.hasClass('has-error')){
                    inputDiv.append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                }
                else {
                    inputDiv.append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
                }
            };
        };
    };

});