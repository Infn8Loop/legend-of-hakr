<div style="height: 400px"></div>
<div class="bottom-pad" style="height: 300px;"></div>

<div id="footer">
<?php if($this->session->id){$this->load->view("includes/bottom-stats");} ?>
</div>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo site_url('assets/js/script.js');?>"></script>
</body>
</html>
