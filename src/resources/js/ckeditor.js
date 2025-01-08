import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

// Khởi tạo CKEditor cho tất cả các textarea có class 'ckeditor'
document.addEventListener("DOMContentLoaded", () => {
    const editors = document.querySelectorAll(".ckeditor");

    editors.forEach((element) => {
        ClassicEditor.create(element, {
            // Cấu hình toolbar
            toolbar: [
                "heading",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "|",
                "blockQuote",
                "insertTable",
                "|",
                "undo",
                "redo",
            ],
            // Cấu hình ngôn ngữ
            language: "vi",
            // Cấu hình chiều cao
            height: "400px",
        })
            .then((editor) => {
                // Xử lý khi editor được khởi tạo thành công
                console.log("Editor initialized", editor);

                // Thêm xử lý khi nội dung thay đổi
                editor.model.document.on("change:data", () => {
                    // Cập nhật giá trị của textarea gốc
                    element.value = editor.getData();
                });
            })
            .catch((error) => {
                console.error("Editor error:", error);
            });
    });
});

// Hàm xử lý nội dung từ CKEditor
export function cleanEditorContent(content) {
    // Danh sách các thẻ được phép
    const allowedTags = [
        "p",
        "br",
        "b",
        "strong",
        "i",
        "em",
        "u",
        "h1",
        "h2",
        "h3",
        "h4",
        "h5",
        "h6",
    ];

    // Pattern để tìm tất cả các thẻ HTML
    const pattern = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;

    return content.replace(pattern, function (match, tag) {
        if (allowedTags.indexOf(tag.toLowerCase()) !== -1) {
            return match;
        }
        return "";
    });
}

// Hàm lấy text thuần túy
export function stripHTMLTags(content) {
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = content;
    return tempDiv.textContent || tempDiv.innerText;
}
