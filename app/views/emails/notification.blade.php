De: {{ $input['name'] }}, {{ $input['email'] }}<br />
Telefono: {{ $input['phone'] ? $input['phone'] : 'No provisto' }}<br />
Mensaje:<br />
	{{ $input['message'] }}