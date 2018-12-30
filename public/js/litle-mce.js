tinymce.init({
  selector: 'textarea',
  menubar: false,
  theme: 'modern',
  image_description: false,
  link_title: false,
  plugins: [
    'table paste','image','emoticons','autolink link lists media',
  ],
  toolbar: 'styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image media link table emoticons',
  imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.css',
    '//www.tinymce.com/css/codepen.min.css',
  ],
  style_formats: [
    {title: "Headers", items: [
        {title: "Header 3", format: "h3"},
        {title: "Header 4", format: "h4"},
        {title: "Header 5", format: "h5"},
        {title: "Header 6", format: "h6"}
    ]},
  ]
});