<h2>Add QSO</h2>

<?php if($notice) { ?>
<div id="message" >
	<?php echo $notice; ?>
</div>
<?php } ?>

<div class="wrap_content">
<script type="text/javascript">
setInterval("settime()", 1000);

function settime () {
  var curtime = new Date();
  var curhour = curtime.getHours();
  var curmin = curtime.getMinutes();
  var cursec = curtime.getSeconds();
  var time = "";

  if(curhour == 0) curhour = 24;
  time = (curhour > 24 ? curhour - 24 : curhour - 1) + ":" +
		 (curmin < 10 ? "0" : "") + curmin + ":" +
		 (cursec < 10 ? "0" : "") + cursec

  document.qsos.start_time.value = time;
}
</script>

<table class="logbook" width="100%">
	<tr class="log_title titles">
		<td>Date</td>
		<td>Time</td>
		<td>Call</td>
		<td>Mode</td>
		<td>Sent</td>
		<td>Recv</td>
		<td>Band</td>
	</tr>

	<?php $i = 0; 
 foreach ($query->result() as $row) { ?>

		<?php  echo '<tr class="tr'.($i & 1).'">'; ?>
		<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('d/m/y', $timestamp); ?></td>
		<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('H:i', $timestamp); ?></td>
		<td><?php echo strtoupper($row->COL_CALL); ?></td>
		<td><?php echo $row->COL_MODE; ?></td>
		<td><?php echo $row->COL_RST_SENT; ?></td>
		<td><?php echo $row->COL_RST_RCVD; ?></td>
		<td><?php echo $row->COL_BAND; ?></td>
	</tr>
	<?php $i++; } ?>

</table>


<?php echo validation_errors(); ?>

<form id="qso_input" method="post" action="<?php echo site_url('qso'); ?>" name="qsos">

<table width="100%">

	<tr class="log_title">
		<td class="title">Date</td>
		<td class="title">Time</td>
		<td class="title">Callsign</td>
		<?php if($this->config->item('display_freq') == true) { ?>
		<td class="title">Freq</td>
		<?php } ?>
		<td class="title">Mode</td>
		<td class="title">Band</td>
		<td class="title">RST Sent</td>
		<td class="title">RST Recv</td>
		<td class="title">QRA</td>
<!-- 		<td class="title">Name</td> -->
		<td class="title">Comment</td>
	</tr>
	
	<tr>
		<td><input class="input_date" type="text" name="start_date" value="<?php echo date('d-m-Y'); ?>" size="10" /></td>
		<td><input class="input_time" type="text" name="start_time" value="" size="7" /></td>
		<td><input size="10" id="callsign" type="text" name="callsign" value="" /></td>
		<td><select name="mode">
			<option value="SSB" <?php if($this->session->userdata('mode') == "" || $this->session->userdata('mode') == "FM") { echo "selected=\"selected\""; } ?>>SSB</option>
			<option value="FM" <?php if($this->session->userdata('mode') == "FM") { echo "selected=\"selected\""; } ?>>FM</option>
			<option value="CW" <?php if($this->session->userdata('mode') == "CW") { echo "selected=\"selected\""; } ?>>CW</option>
			<option value="RTTY" <?php if($this->session->userdata('mode') == "RTTY") { echo "selected=\"selected\""; } ?>>RTTY</option>
			<option value="PSK31" <?php if($this->session->userdata('mode') == "PSK31") { echo "selected=\"selected\""; } ?>>PSK31</option>
			<option value="PSK63" <?php if($this->session->userdata('mode') == "PSK63") { echo "selected=\"selected\""; } ?>>PSK31</option>
			<option value="JT65" <?php if($this->session->userdata('mode') == "JT65") { echo "selected=\"selected\""; } ?>>JT65</option>
			<option value="JT65B" <?php if($this->session->userdata('mode') == "JT65B") { echo "selected=\"selected\""; } ?>>JT65B</option>
			<option value="JT6M" <?php if($this->session->userdata('mode') == "JT6M") { echo "selected=\"selected\""; } ?>>JT6M</option>
			<option value="FSK441" <?php if($this->session->userdata('mode') == "FSK441") { echo "selected=\"selected\""; } ?>>FSK441</option>
		</select></td> 
		
		<td><select name="band">
			<option value="160m" <?php if($this->session->userdata('band') == "160m") { echo "selected=\"selected\""; } ?>>160m</option>
			<option value="80m" <?php if($this->session->userdata('band') == "80m") { echo "selected=\"selected\""; } ?>>80m</option>
			<option value="40m" <?php if($this->session->userdata('band') == "40m") { echo "selected=\"selected\""; } ?>>40m</option>
			<option value="30m" <?php if($this->session->userdata('band') == "30m") { echo "selected=\"selected\""; } ?>>30m</option>
			<option value="20m" <?php if($this->session->userdata('band') == "20m") { echo "selected=\"selected\""; } ?>>20m</option>
			<option value="17m" <?php if($this->session->userdata('band') == "17m") { echo "selected=\"selected\""; } ?>>17m</option>
			<option value="15m" <?php if($this->session->userdata('band') == "15m") { echo "selected=\"selected\""; } ?>>15m</option>
			<option value="12m" <?php if($this->session->userdata('band') == "12m") { echo "selected=\"selected\""; } ?>>12m</option>
			<option value="10m" <?php if($this->session->userdata('band') == "10m") { echo "selected=\"selected\""; } ?>>10m</option>
			<option value="6m" <?php if($this->session->userdata('band') == "6m") { echo "selected=\"selected\""; } ?>>6m</option>
			<option value="4m" <?php if($this->session->userdata('band') == "4m") { echo "selected=\"selected\""; } ?>>4m</option>
			<option value="2m" <?php if($this->session->userdata('band') == "2m") { echo "selected=\"selected\""; } ?>>2m</option>
			<option value="70cm" <?php if($this->session->userdata('band') == "70cm") { echo "selected=\"selected\""; } ?>>70cm</option>
		</select></td>
		<td><select name="rst_sent">
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59" selected="selected">59</option>
			<option value="59+10dB">59+10dB</option>
			<option value="59+20dB">59+20dB</option>
			<option value="59+30dB">59+30dB</option>
		</select></td>
		<td><select name="rst_recv">
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59" selected="selected">59</option>
			<option value="59+10dB">59+10dB</option>
			<option value="59+20dB">59+20dB</option>
			<option value="59+30dB">59+30dB</option>
		</select></td>
		<td><input id="locator" type="text" name="locator" value="" size="7" /></td>
<!-- 		<td><input type="text" name="name" value="" /></td> -->
		<td><input type="text" name="comment" value="" /></td>
	</tr>
	
</table>

<div class="info">
	<input size="20" id="country" type="text" name="country" value="" /> <span id="locator_info"></span>
</div>


		<div id="tabs">

			<ul>
				<li><a href="#tabs-1">Logbook</a></li>
				<li><a href="#tabs-2">Satellite</a></li>
				<li><a href="#tabs-3">Station</a></li>
			</ul>

			<div id="tabs-1"><div id="partial_view">Partial Callsign Check</div></div>

			<div id="tabs-2">
				<table>
					<tr>
						<td class="title">Sat Name</td>
						<td><input type="text" name="sat_name" value="" /></td>
					</tr>
	
					<tr>
						<td class="title">Sat Mode</td>
						<td><input type="text" name="sat_mode" value="" /></td>
					</tr>
				</table>
			</div>
			
			<div id="tabs-3">
				<table>
					<tr>
						<td>Radio</td>
						<td><input type="text" name="equipment" value="" /></td>
					</tr>
					<?php if($this->config->item('display_freq') == true) { ?>
					<tr>
						<td>Frequnecy</td>
						<td><input type="text" name="freq" value="<?php if($this->session->userdata('freq') != null) { echo $this->session->userdata('freq'); } ?>" /></td>
					</tr>
					<?php } ?>
				</table>
				
			</div>

		</div>
<div class="controls"><input type="submit" value="Add QSO" /></div>

</form>
<script type="text/javascript">
i=0;
$(document).ready(function(){
	$("#locator").keyup(function(){
		if ($(this).val()) {
			$('#locator_info').load("logbook/bearing/" + $(this).val()).fadeIn("slow");
		}
	});

  $("#callsign").keyup(function(){
  	if ($(this).val()) {
	$('#partial_view').load("logbook/partial/" + $(this).val()).fadeIn("slow");
	
	$.get('logbook/find_dxcc/' + $(this).val(), function(result) {
	$('#country').val(result);
		});
	}

  });
});
</script>

</div>