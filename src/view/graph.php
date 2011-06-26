<!-- @todo change "simple" graph inclusion -->
<div id="<?=$this->metric?>" style="float: left; height:240px; width:600px; "></div>

<script language="javascript" type="text/javascript">
    var <?=$this->metric?> = $.jqplot(
        '<?=$this->metric?>',
        <?=json_encode($this->data)?>,
        {
            title:'<?=$this->title?>',
            gridPadding:{right:65,left:65,bottom:65},
            axes: {
                yaxis:{min:0},
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{formatString:'%H:%M'}
                }
            },
            series:[{color:'#A00000',lineWidth:2,  showMarker:false,markerOptions:{style:'square'}}],
      cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } 
        }
    );
    // tickInterval:'1 day'
    // yaxis:{min:-10, max:240},
    // formatString:'%d.%m. %H:%I'
    //$('#reset-<?=$this->metric?>').click(function() { <?=$this->metric?>.resetZoom() });
</script>
