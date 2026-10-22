const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box");

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    $(".logo-1").toggleClass("d-none");
    $(".logo-2").toggleClass("d-none");
})

let toolbaroptions = [
    ['bold', 'italic', 'underline', 'strike'],
    ['blockquote', 'code-block'],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [{ 'script': 'sub' }, { 'script': 'super' }],
    [{ 'indent': '-1' }, { 'indent': '+1' }],
    [{ 'direction': 'rtl' }],
    [{ 'size': ['small', false, 'large', 'huge'] }],
    ['link', 'image', 'video', 'formula'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'font': [] }],
    [{ 'align': [] }],
    ['table']

];

Quill.register({
    'modules/tableUI': quillTableUI.default
}, true)

Quill.register('modules/imageResize', QuillResizeModule);

if ($("#editor").length != 0) {
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: toolbaroptions,
            imageResize: {}
        }
    });
}

if ($("#editor1").length != 0) {
    var quill2 = new Quill('#editor1', {
        theme: 'snow',
        modules: {
            toolbar: toolbaroptions,
            imageResize: {}
        }
    });
}

if ($("#editor2").length != 0) {
    var quill3 = new Quill('#editor2', {
        theme: 'snow',
        modules: {
            toolbar: toolbaroptions,
            imageResize: {}
        }
    });
}


function changeNav(id) {
    $("#" + id).addClass("nav-active");
}

$(".datatable").DataTable({});


function generateKeyword(title) {
        let keyword = title.toLowerCase().replace(/ /g, '-').replace(/&/g, '-');
        return keyword;
    }
    
    function checkKeyword(keyword, checkType,typeId){
        $.ajax({
            url: 'assets/functions/functions.php',
            type: 'POST',
            data: { check_keyword: keyword, type: checkType, typeId:typeId },
            success : function(response){
                console.log(response)
                response = JSON.parse(response)
                if (response.isUnique) {
                   $('#submit').attr('disabled',false)
                   $('#keywordMessage').text('* Keyword is available').removeClass('text-danger').addClass('text-success')
                }else{
                   $('#submit').attr('disabled',true)
                   $('#keywordMessage').text('* Keyword is not available').removeClass('text-success').addClass('text-danger')
                }
                $('#keyword').val(keyword);
            }
        })
    }