
                   <form role="form" method="POST" action="{{ url('api/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       name <input type="text" name="first_name">
                       lname <input type="text" name="last_name">
                       email <input type="text" name="email">
                    password    <input type="text" name="password">
                    <input type="submit" name="test" value="save">
</form>
<style >
    input {
        border:red 1px solid;
    }
</style>


