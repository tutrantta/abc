/*
 * Common script
 *
 * Date                Author     Content
 * ----------------------------------------------------
 * 2015-04-13          NgocNguyen     Create File
 */

 function ready() {
    selectItemsOnList();
    $(window).on('beforeunload', function () {
    });
    AutocompleteOff();
}

function selectItemsOnList() {
    var select = new Select();
    select.bindChangeEvent();
}

$(document).ready(ready);
$(document).on('page:load', ready);


/*=====================CLASS: SELECT ITEM  > BEGIN========================*/

function Select() {
    var pointer = this;
    this._select_input = $("[data-select=input]");
    this._select_input_attent = $("[data-select=input-attent]");
    this._select_input_attent_new = $("[data-select=input-attent-new]");
    this._select_input_attent_old = $("[data-select=input-attent-old]");
    this._select_input_attent_delete = $("[data-select=input-attent-delete]");
    this._button_add = $("[data-button=add]");
    this._button_remove = $("[data-button=remove]");
    this._tbody = $("[data-list=table]");
    this._tbody_attent = $("[data-list=table-attent]");
    this._table_engineer = $("[data-table=engineer]") ;
    this._div_message = $("[data-message=div-message]");
    var _select_data = new Array();
    var _select_data_attent = new Array();
    var _select_data_attent_new = new Array();
    var _select_data_attent_delete = new Array();

    this.bindChangeEvent = function () {
        $("[data-select=all]").bind('change', function () {
            _select_data = new Array();
            if ($(this).is(":checked")) {
                $("[data-select=item]").prop('checked', true);
                $("[data-select=item]").filter(":checked").each(function () {
                    _select_data.push($(this).val());
                });
                //remove value
                $.each($("[data-select=input-attent]").val().split(","), function(key,value ) {
                    _select_data.removeByVal(value);
                });
                pointer.bindDataInput();

            } else {
                $("[data-select=item]").prop('checked', false);
                _select_data = [];
            }
            pointer.bindDataInput();
        });

        $(document).on('change','[data-select=item]', function () {
            var allIsChecked = $("[data-select=all]").is(":checked");
            if ($(this).is(":checked")) {
                if ($.inArray($(this).val(), _select_data) === -1) {
                    _select_data.push($(this).val());
                }
            } else {
                if (allIsChecked) {
                    $("[data-select=all]").prop('checked', false);
                    _select_data = new Array();
                    $("[data-select=item]").filter(":checked").each(function () {
                        _select_data.push($(this).val());
                    });
                }
                _select_data.removeByVal($(this).val());
            }
            pointer.bindDataInput();
        });

        this._button_add.bind('click', function () {
            $("[data-select=all]").prop('checked', false);
            //check required
            if(pointer._select_input.val() == ''){
                $("#modal-error").modal();
                return false;         
            }
            //convert string to array
            var data = pointer._select_input.val().split(",");
            $.each( data, function(key,value ) {
              _select_data_attent.push(value);
              _select_data_attent_delete.removeByVal(value);

              //add data
              var data = '<tr class="info" data-attent="'+value+'" employee_code="'+$('[data-engineer='+value+']').attr('employee_code')+'" fullname="'+$('[data-engineer='+value+']').attr('fullname')+'"><td><input type="checkbox" value="'+value+'" data-select="item-attent"/></td>';
              data += '<td>'+$('[data-engineer='+value+']').attr('employee_code')+'</td>';
              data += '<td>'+$('[data-engineer='+value+']').attr('fullname')+'</td>';
              data += '</tr>';
              $('[data-div=hidden]').prepend(data);
              pointer._tbody.prepend($('[data-attent='+value+']').fadeOut('fast').fadeIn('5000').delay(5200).fadeIn('fast', function() {
                  $(this).removeAttr('class');
              }));
              $('[data-engineer='+value+']').remove();
              pointer.checkButtonUpdateExam();
              //add message
              /*
              var message = '<div data-message="'+value+'" class="alert alert-success" data-div="message"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Well done!</strong>';
              message += '<span data-message="message"> Add '+$('[data-attent='+value+']').attr('fullname')+' Successful ! </span>';
              message += '</div><br/>';
              $('[data-div=hidden]').prepend(message);
              pointer._div_message.prepend($('[data-message='+value+']').fadeIn('fast').delay(5000).fadeOut('fast', function() {
                    $(this).remove();
              }));
              */
            });
            //remove value if id had assigned
            $.each(pointer._select_input_attent_old.val().split(","), function(key,value ) {
                _select_data_attent.removeByVal(value);
            });
            _select_data = [];
            pointer._select_input.val('');
            pointer.bindDataInput();
        });

        $("[data-select=all-attent]").bind('change', function () {
            _select_data_attent_new = new Array();
            if ($(this).is(":checked")) {
                $('[data-select=item-attent]').prop('checked', true);
                $('[data-select=item-attent]').filter(":checked").each(function () {
                    _select_data_attent_new.push($(this).val());
                });
                //remove value
                $.each( pointer._select_input.val().split(","), function(key,value ) {
                    _select_data_attent_new.removeByVal(value);
                });
                pointer.bindDataInput();
            } else {
                $('[data-select=item-attent]').prop('checked', false);
                _select_data_attent_new = [];
            }
            pointer.bindDataInput();
        });

        $(document).on('change','[data-select=item-attent]', function () {
            var allIsChecked = $("[data-select=all-attent]").is(":checked");
            if ($(this).is(":checked")) {
                if ($.inArray($(this).val(), _select_data_attent_new) === -1) {
                    _select_data_attent_new.push($(this).val());
                }
            } else {
                if (allIsChecked) {
                    $("[data-select=all-attent]").prop('checked', false);
                    _select_data_attent_new = new Array();
                    $('[data-select=item-attent]').filter(":checked").each(function () {
                        _select_data_attent_new.push($(this).val());
                    });
                }
                _select_data_attent_new.removeByVal($(this).val());
            }
            pointer.bindDataInput();
        });

        this._button_remove.bind('click', function () {
            $("[data-select=all-attent]").prop('checked', false);
            //check required
            if(pointer._select_input_attent_new.val() == ''){
                $("#modal-error").modal();
                return false;         
            }
            //convert string to array
            var data = pointer._select_input_attent_new.val().split(",");
            $.each( data, function(key,value ) {
              _select_data_attent_delete.push(value);  
              _select_data_attent.removeByVal(value);

              //add data
              var data = '<tr class="info" data-engineer='+value+' employee_code="'+$('[data-attent='+value+']').attr('employee_code')+'" fullname="'+$('[data-attent='+value+']').attr('fullname')+'"><td><input type="checkbox" value="'+value+'" data-select="item"/></td>';
              data += '<td>'+$('[data-attent='+value+']').attr('employee_code')+'</td>';
              data += '<td>'+$('[data-attent='+value+']').attr('fullname')+'</td>';
              data += '</tr>';
              $('[data-div=hidden]').prepend(data);
              pointer._tbody_attent.prepend($('[data-engineer='+value+']').fadeOut('fast').fadeIn('5000').delay(5200).fadeIn('fast', function() {
                  $(this).removeAttr('class');
              }));
              $('[data-attent='+value+']').remove();
              pointer.checkButtonUpdateExam();
              //add message
              /*
              var message = '<div data-message="'+value+'" class="alert alert-danger" data-div="message"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Well done!</strong>';
              message += '<span data-message="message"> Remove '+$('[data-engineer='+value+']').attr('fullname')+' Successful ! </span>';
              message += '</div><br/>';
              $('[data-div=hidden]').prepend(message);
              pointer._div_message.prepend($('[data-message='+value+']').fadeIn('fast').delay(5000).fadeOut('fast', function() {
                    $(this).remove();
              }));
              */
          });
            _select_data_attent_new = [];
            pointer._select_input_attent_new.val('');
            pointer.bindDataInput();
        });
    };

    this.bindDataInput = function () {
        this._select_input.val(_select_data.join());
        this._select_input_attent.val(_select_data_attent.join());
        this._select_input_attent_new.val(_select_data_attent_new.join());
        this._select_input_attent_delete.val(_select_data_attent_delete.join());
    };

    this.checkButtonUpdateExam = function () {
       var rowCount = $('[data-table=unassignee] >tbody >tr').length;
       if(rowCount > 0){
          $('[data-button=update-exam]').removeAttr('disabled');
       }else{
          $('[data-button=update-exam]').attr('disabled',true);
       }
    }
}

/*=====================CLASS: SELECT ITEM  > END========================*/


/*=====================COMMON JQUERY FUNCTION  > BEGIN===================*/


function AutocompleteOff() {
    var pointer = this;
    $('input[type=checkbox]').each(function () {
        $(this).attr('autocomplete', 'off');
    });
}

Array.prototype.removeByVal = function (val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};

$.fn.popupMessage = function (flag) {
    if (flag === 'show') {
        this.removeClass('hidden');
        this.addClass('show');
    } else {
        this.removeClass('show');
        this.addClass('hidden');
    }

};

/*=====================COMMON JQUERY FUNCTION  > END====================*/