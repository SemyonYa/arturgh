$(document).ready(function () {
    $('#SelectParentModal').on('show.bs.modal', function () {
        LoadParentList($(this).attr('data-self-id'), $(this).attr('data-parent-id'));
    });
});
function GoTo(url) {
    location = url;
}
function LoadParentList(id, parentId) {
    $('#SelectParentModal').load('/client/parent-list?id=' + id + '&parent_id=' + parentId);
}

function SelectParent(id, fio) {
    $('#ClientParentId').val(id);
    $('#ClientParentFio').val(fio);
    $('#SelectParentModal').modal('hide');
    $('#SelectParentModal').empty();
}

function FilteringParentList(obj) {
    const str = $(obj).val().toLowerCase().trim();
    if (str.length > 1) {
        alert(str);
        $('.parent-item').each(function () {
            $(this).css('display', ($(this).html().toLowerCase().indexOf(str) === -1) ? 'none' : 'block');
        });
    }
}
