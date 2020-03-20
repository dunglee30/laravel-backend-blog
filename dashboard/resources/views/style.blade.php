<script src="{{ asset('node_modules/tinymce/tinymce.js') }}" referrerpolicy="origin"></script>
  <script type="text/javascript">
  tinymce.init({
    selector: '#id_content',
    height: 600,
    branding: false
  });
</script>

<style>
        .sidebar {
            position: fixed;
            top: 100px;
            bottom: 0;
            left: 20px;
            z-index: 1000;
            padding: 20px 0;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            border-right: 1px solid #eee;
        }

        .sidebar .nav {
            margin-bottom: 20px;
        }

        .sidebar .nav-item {
            width: 100%;
        }

        .sidebar .nav-item + .nav-item {
            margin-left: 0;
        }

        .sidebar .nav-link {
            border-radius: 0;
        }

        p {
            display: block;
            margin: 10px;
            max-width: 100%;
            overflow-wrap: break-word;
        }
        #form-area {
            max-width: 90%;
        }
        .title-area {
            display: flex;
            justify-content: Center;
        }

        .author-name-area {
            margin-left: 100px;
        }
        #ED-area {
            display: flex;
            justify-content: Center;
        }

        #ED-area a{
            padding: 5px;
        }

</style>