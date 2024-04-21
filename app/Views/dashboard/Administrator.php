<!-- 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<iframe src="http://192.168.22.30:3000/d-solo/fdh5xlq92zsaoc/new-dashboard?orgId=1&from=1711730095655&to=1711751695656&theme=light&panelId=1" class="w-1/2" frameborder="0"></iframe>



    <iframe id="dashboard"></iframe>

    <script type="text/javascript">
  $.ajax(
    {
      type: 'GET',
      url: 'http://192.168.22.30:3000/d-solo/fdh5xlq92zsaoc/new-dashboard?orgId=1&from=1711730095655&to=1711751695656&theme=light&panelId=1',
      contentType: 'application/json',
      beforeSend: function(xhr, settings) {
        xhr.setRequestHeader(
          'Authorization', 'Basic ' + window.btoa('viewer:viewer')
        );
      },
      success: function(data) {
        $('#dashboard').attr('src', 'http://192.168.22.30:3000/d-solo/fdh5xlq92zsaoc/new-dashboard?orgId=1&from=1711730095655&to=1711751695656&theme=light&panelId=1');
        $('#dashboard').contents().find('html').html(data);
      }
    }
  );
</script> -->

<!-- <iframe src="https://gra.bc.dawg/d-solo/edhnkbg2lsdfkf/bcdlab-project?orgId=1&refresh=auto&theme=light&panelId=1" frameborder="0" class="w-1/2 pointer-events-none aspect-video"></iframe>
  <iframe src="https://gra.bc.dawg/d-solo/edhnkbg2lsdfkf/bcdlab-project?orgId=1&refresh=auto&theme=light&panelId=1" frameborder="0" class="w-1/2 pointer-events-none aspect-video"></iframe> -->

    <iframe src="https://grafana.bcdlab.xyz/d-solo/adj0l3f4g8934f/public-dashboard?orgId=1&theme=light&panelId=2" frameborder="0" class="w-1/2 pointer-events-none aspect-video" allowtransparency="true" style="background-color: transparent;"></iframe>