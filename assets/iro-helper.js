
function colBtn(idBtn, color) {
    let btn = document.getElementById(idBtn);
    if (btn) btn.style.backgroundColor = color;
}

function installIro(id, opts, colorFormat)
{
    colBtn( id + '-btn', opts.color);
    let r = new iro.ColorPicker('#' + id + '-iro', opts);
    r.on('color:change', function(col, changes) {
        document.getElementById(id).value = col[colorFormat];

        colBtn(id + '-btn', r.state.transparency ? col.hex8String : col.hexString);
    });
    return r;
}
