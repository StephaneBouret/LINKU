$(document).ready(function(){

    $(function(){
		function _confirm()
		{
			return (confirm('Voulez-vous clore le ticket ?'));
		}
		$('#closeTicket').click(_confirm);
    });

});