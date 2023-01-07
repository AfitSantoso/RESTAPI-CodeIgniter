const setNumber = (e) =>
{
    let key_code = (document) ? e.keyCode : e.which;

    // jika kode ascii 48 - 57 (0 - 9)
    if(key_code >= 48 && key_code <= 57)
    {
        return true;
    }
    // jika kode ascii tidak 48 - 57 (0 - 9)
    else
    {
        return false
    }
}