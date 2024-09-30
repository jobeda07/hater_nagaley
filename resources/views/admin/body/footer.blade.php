<footer class="main-footer font-xs">
    <div class="row pb-30 pt-15">
        <div class="col-sm-6">
            <script>
                document.write(new Date().getFullYear());
            </script>
            {{ get_setting('copy_right')->value ?? 'null' }}
        </div>
        <div class="col-sm-6">
            <div class="text-sm-end">Developed by: <a target="_blank" href="https://classicit.com.bd/">Classic it & Sky Mart Ltd</a></div>
        </div>
    </div>
</footer>