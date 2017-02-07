<div class="modal fade" id="companyModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form class="form-horizontal" id="companyForm" action="javascript:void(0);" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 id="companyModalLabel"><span id="modalType">Add</span> Company</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pkcoid" id="pkcoid" />
                    <input type="hidden" name="type" id="type" value="add"/>
                    <div class="form-group bottom-buffer">
                        <label class="col-lg-4 control-label">Company Name: </b></label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" placeholder="Enter Company Name" name="companyName" id="companyName">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8 text-left top-buffer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" name="addCompanyCancelBtn" id="addCompanyCancelBtn" >Cancel</button>
                            <button type="submit" class="btn btn-primary" name="addCompanySubmitBtn" id="addCompanySubmitBtn">Submit</button>
                            <span class="hide" id="loadingForAddCompany">
                                <img src="img/ajax-loading.gif" >
                                Please Wait...
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var companyFormValidator = $("#companyModal #companyForm").validate({
        rules: {
            companyName: {
                required: true
            },
        }
    });

    $.widget("custom.modelCompany", {
        options: {
            pkcoid: 0,
            success: function () {
            }
        },
        _create: function () {
            var _this = this;
            this.$form = $("#companyModal #companyForm");

            this.$form.on("submit", function (event) {
                event.preventDefault();
                var isFormValid = companyFormValidator.form();
                if (isFormValid) {
                    _this.submitFormViaAjax();
                }
                return false;
            });

        },
        showCompanyModel: function (pkuid) {
            var _this = this;
            if (!_this.options.pkcoid) {
                _this.clearAndShowModel();
            } else {
                _this.fetchAndShowModel();
            }

        },
        _setOption: function (key, value) {
            this._super(key, value);
        },
        _setOptions: function (options) {
            this._super(options);
        },
        clearAndShowModel: function () {
            this.$form[0].reset();
            $("#companyModal #pkcoid").val(0);
            $("#companyModal #type").val("add");
            $('#companyModalLabel #modalType').html('Add');
            $("#companyModal").modal('show');
        },

        fetchAndShowModel: function () {
            var _this = this;
            $.ajax({
                type: "GET",
                url: "process/processCompany.php",
                data: {pkcoid: this.options.pkcoid, type: 'getCompanyByID'},
                success: function (data) {
                    var obj = JSON.parse(data);


                    $("#companyModal #companyName").val(obj.coname);
                    $("#companyModal #pkcoid").val(obj.pkcoid);
                    $("#companyModal #type").val("update");
                    $('#companyModalLabel #modalType').html('Update');
                    $("#companyModal").modal('show');
                }
            });
        },
        submitFormViaAjax: function () {
            var _this = this;
            $.ajax({
                type: "POST",
                url: "process/processCompany.php",
                data: this.$form.serialize(),
                beforeSend: function() {
                    $('#companyModal #loadingForAddCompany').removeClass('hide');
                    $('#companyModal button#addCompanySubmitBtn').prop('disabled',true);
                    $('#companyModal button#addCompanyCancelBtn').prop('disabled',true);
                },
                success: function (data) {
                    $('#companyModal #loadingForAddCompany').addClass('hide');
                    $('#companyModal button#addCompanySubmitBtn').prop('disabled',false);
                    $('#companyModal button#addCompanyCancelBtn').prop('disabled',false);

                    var jsonData = jQuery.parseJSON(data);
                    if (jsonData['success'] == true) {
                        $('#companyModal').modal('hide');
                    }
                    fnToastSuccess(jsonData['message']);
                    if (typeof _this.options.success === "function") {
                        _this.options.success(jsonData);
                    }
                    return false;
                }
            });
        },
        _destroy: function () {

        }
    });
</script>
