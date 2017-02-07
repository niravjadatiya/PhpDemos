<?php
require_once 'includes/headerLatest.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Companies</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a>Companies</a>
            </li>                        
        </ol>
    </div>        
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">         
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Companies</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a id="addCompany" href="javascript:void(0);">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-hover company_list" width="100%">
                        <thead>
                            <tr>                                    
                                <th>#</th>
                                <th>Company Name</th>                                    
                                <th>Created Date</th>  
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>	
                        </tbody>
                        <tfoot>
                            <tr>                                    
                                <th>#</th>
                                <th>Company Name</th>                                    
                                <th>Created Date</th>  
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'includes/footerLatest.php';
    require_once './jsmodel/modalAddCompany.php';
?>

<script>
    var companyTable = '';
    
    $(document).ready(function () {
        companyTable = $('.company_list').dataTable({
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bServerSide": true,
            "bStateSave": true,
            "bRedraw": true,
            "order": [[0, "asc"]],
            "sAjaxSource": "dtscripts/companyData.php",
            "aoColumns": [
                {"mData": "DT_RowId", "sWidth": "8%"},
                {"mData": "coname", "sWidth": "30%"},
                {"mData": "created", "sWidth": "20%"},
                {
                    "mData": null,
                    "sWidth": "4%",
                    "mRender": function (o) {
                        return "<a href='javascript:void(0);' class='editCompany' pkcoid = "+ o.DT_RowId +" ><i class='fa fa-edit'></i></a>";
                    },
                    "sDefaultContent": ""
                },
                {
                    "mData": null,
                    "sWidth": "4%",
                    "mRender": function (o) {
                        return "<a href='javascript:void(0);' class='deleteCompany' pkcoid = "+ o.DT_RowId +" ><i class='fa fa-trash'></i></a></a>";
                    },
                }
            ],
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [3]},
                {"bSortable": false, "aTargets": [4]}

            ],
            "fnDrawCallback": function( oSettings ) {
                
            }
        });

        $(document).on('click', '.deleteCompany', function (e) {
            var pkcoid = $(this).attr('pkcoid');
            var r = confirm("Are You Sure Delete Company ?");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "process/processCompany.php",
                    data: {pkcoid: pkcoid, type: 'delete'},
                    dataType: 'json',
                    success: function (data) {
                        companyTable.fnDraw();
                        fnToastSuccess(data.message);
                    }
                });
            } else {

            }
        });
    });
    
    modelCompany = $("body").modelCompany().data("custom-modelCompany");
    
    $(document).on('click', '#addCompany', function (e) {
        modelCompany.option({
            pkcoid: 0,
            success: function (data) {
                companyTable.fnDraw(false);
            }
        }).showCompanyModel();
    });
    
    $(document).on('click', '.editCompany', function (e) {
        var pkcoid = $(this).attr('pkcoid');
        modelCompany.option({
            pkcoid: pkcoid,
            success: function (data) {
                companyTable.fnDraw(false);
            }
        }).showCompanyModel();

    });
    
</script>

