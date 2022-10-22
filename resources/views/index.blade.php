
@extends('layout')


@section('content')

@isset($records)
<?php
$i=0;
foreach( $records as $index => $row )
{
		echo '<div class="row">#'. $index . ' - '. $row["firstname"] . ' ' . $row["lastname"] . ' ' . $row["phone"] . ' <a href="/record/remove/'.$index.'">   delete  </a> </div>';

		$i++;
}
?>
@endisset

<form action="/record/save" method="POST">
	@csrf
		<input type="text" name="firstname"/>
		<input type="text" name="lastname"/>
		<input type="text" name="phone"/>
		<input type="submit" value="Send"/>
</form>


@stop
