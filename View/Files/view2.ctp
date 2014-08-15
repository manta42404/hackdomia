<div class="large-12 columns" style="margin-top:-60px">*
	<div id="documentViewer" class="flexpaper_viewer" style="width:100%;height:500px"></div>
<script type="text/javascript">
    function getDocumentUrl(document){
        return "/php/services/view.php?doc={doc}&format={format}&page={page}".replace("{doc}",document);
    }

    var startDocument = "Paper";

    $('#documentViewer').FlexPaperViewer(
            { config : {

                SWFFile : <?php echo '/files/'.$file['File']['filename']; ?>

                Scale : 0.6,
                ZoomTransition : 'easeOut',
                ZoomTime : 0.5,
                ZoomInterval : 0.2,
                FitPageOnLoad : true,
                FitWidthOnLoad : false,
                FullScreenAsMaxWindow : false,
                ProgressiveLoading : false,
                MinZoomSize : 0.2,
                MaxZoomSize : 5,
                SearchMatchAll : false,
                InitViewMode : 'Portrait',
                RenderingOrder : 'flash',
                StartAtPage : '',

                ViewModeToolsVisible : true,
                ZoomToolsVisible : true,
                NavToolsVisible : true,
                CursorToolsVisible : true,
                SearchToolsVisible : true,
                WMode : 'window',
                localeChain: 'en_US'
            }}
    );
</script>
</div>
<?php $this->start('css'); ?>
	<?php echo $this->Html->css('flexpaper') ?>
<?php $this->end(); ?>
<?php $this->start('script'); ?>
	<?php echo $this->Html->script('flexpaper') ?>
<?php $this->end(); ?>