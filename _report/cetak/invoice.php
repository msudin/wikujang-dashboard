<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Cetak Pembayaran</title>
    <link href="w3.css" rel="stylesheet"/>

    <style>

#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body>
     <div class="w3-right footer">
        <button id="print" class="w3-button w3-blue">Print Faktur Pembayaran</button>
    </div>
    <div class="container">
        <!--<h2 align="center">SMA NEGERI 1 BANGIL</h2>
        <h4 align="center">Jl. Bader No 3. Kalirejo Bangil. Telp (0343)741873</h4>-->
        <table align="center">
            <tr>
                <td style="text-align:center;">SMA NEGERI 1 BANGIL</td>
               
            </tr>
            <tr>
            <td style="text-align:center;">Jl. Bader No 3. Kalirejo Bangil. Telp (0343)741873</td></tr>
        </table>
        
<hr width="100%" align="center">
        
        <form>
            <p>
                <label>Name</label>
                <input type="text" class="w3-input w3-border"/>
            </p>
            <p>
                <label>Email</label>
                <input type="email" class="w3-input w3-border"/>
            </p>
            <p>
                <label>Phone number</label>
                <input type="tel" class="w3-input w3-border"/>
            </p>
            <p>
                <label>Address</label>
                <textarea class="w3-input w3-border"></textarea>
            </p>
        </form>
        <h2>Table</h2>
        <table class="w3-table w3-border w3-bordered w3-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tedir</td>
                    <td>tedir@gmail.com</td>
                    <td>08675665666</td>
                    <td>jl babah dua</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ghazali</td>
                    <td>ghazali@gmail.com</td>
                    <td>08675665667</td>
                    <td>jl babah dua</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Samudra</td>
                    <td>samudra@gmail.com</td>
                    <td>08675665668</td>
                    <td>jl kembang tanjong</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Teuku</td>
                    <td>teuku@gmail.com</td>
                    <td>08675665669</td>
                    <td>jl kembang tanjong</td>
                </tr>
            </tbody>
        </table>
        <h2>Lorem Ipsum 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat dui ut luctus facilisis. Quisque eros dui, fermentum vel tellus nec, hendrerit consectetur nisi. Suspendisse vitae neque maximus, lacinia augue vitae, imperdiet purus. Fusce rutrum tellus eget ligula tempor, eget condimentum tortor aliquam. Donec ullamcorper ornare sem, sit amet consectetur ligula dapibus a. Suspendisse at vehicula arcu. Quisque venenatis quis elit eu vestibulum. In vitae luctus nisl. Phasellus commodo accumsan sem nec rutrum. Cras metus mauris, porttitor a lobortis at, finibus a diam. Donec elementum ex leo, ac laoreet nulla egestas quis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec augue lectus, auctor non risus quis, lobortis aliquet quam. Curabitur vel massa nec eros dapibus aliquet. Quisque at augue nec risus scelerisque rutrum nec vel mauris.</p>
        
        <h2>Lorem Ipsum 2</h2>
        <p>Suspendisse blandit, dolor eget gravida luctus, diam mauris tempor dui, eu molestie nisl odio id eros. Praesent efficitur eget neque vel viverra. Morbi suscipit metus a interdum laoreet. Ut non euismod eros. Etiam sollicitudin fringilla nisl non aliquam. Aenean lacinia cursus augue non accumsan. Aenean sollicitudin varius nulla, ut elementum massa ultrices vel. Duis id arcu sit amet nunc fringilla gravida. Curabitur ac euismod turpis. Mauris efficitur neque porttitor enim fermentum, sit amet varius nibh aliquam. Phasellus congue facilisis sem, a ultricies justo. Praesent molestie est ut metus vulputate ornare non quis ex. Proin dapibus, augue non aliquet mattis, mi lectus fermentum lorem, in interdum risus dolor sed urna.</p>

        <h2>Lorem Ipsum 3</h2>
        <p>Pellentesque magna ante, facilisis at neque quis, vestibulum sodales dolor. Nam ut erat et elit accumsan fermentum. Ut faucibus tempor dolor vitae tempor. Donec ornare scelerisque lectus ut lobortis. Mauris id turpis nec risus pharetra interdum. Morbi viverra ligula eget erat blandit, nec varius nibh eleifend. Integer euismod, nisi in iaculis consequat, erat nisi congue justo, at mollis velit odio nec justo. Aenean consequat auctor nulla, ac vehicula mi laoreet ut. Donec elit erat, euismod ut orci nec, ultricies faucibus justo. Cras laoreet felis massa, nec feugiat felis auctor a. Phasellus eget nulla id turpis dignissim mattis sit amet id ipsum. Proin mauris est, feugiat ut tristique sed, suscipit eu erat. Donec pharetra dictum sagittis. Sed est risus, pellentesque vitae diam ut, vestibulum imperdiet ligula. Praesent iaculis magna velit, nec sagittis mauris lacinia nec.</p>

        <h2>Lorem Ipsum 4</h2>
        <p>Donec non justo a sapien sagittis tempor sed vel quam. Nulla facilisi. Suspendisse bibendum dolor sed auctor mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nisl magna, elementum quis diam id, accumsan lobortis odio. Nam mattis, ipsum id pretium varius, nunc magna consequat velit, eu volutpat purus dui ut massa. Mauris eget nibh justo. Morbi luctus euismod ipsum, sit amet dignissim turpis egestas sit amet. Nulla facilisi. Cras rutrum, libero eu porta euismod, orci nisl mattis sem, eu porta risus dolor id odio. Donec sollicitudin ultricies sem eget fringilla. Maecenas scelerisque purus lacus, eget convallis justo condimentum ullamcorper. Vivamus ac purus non dui porttitor vestibulum a condimentum nisi. Aenean maximus lobortis lobortis.</p>

        <h2>Lorem Ipsum 5</h2>
        <p>Praesent eu erat vel sem viverra mattis mollis a nulla. Pellentesque sed ligula vehicula, gravida tellus et, consequat tortor. Cras sed velit luctus, condimentum dolor sed, lacinia ex. Suspendisse orci elit, rhoncus non venenatis eget, sollicitudin placerat lorem. Quisque lobortis libero mi, id consectetur metus fringilla quis. Nam risus mi, vehicula eget egestas sit amet, cursus quis neque. Cras imperdiet turpis eget risus aliquam luctus.</p>
    </div>
   
    <script src="jquery.min.js"></script>
    <script src="printThis.js"></script>
    <script>
        $('#print').click(function(){
            $('.container').printThis({
                debug: false,           // show the iframe for debugging
                importCSS: true,        // import parent page css
                importStyle: true,     // import style tags
                printContainer: true,   // print outer container/$.selector
                loadCSS: "file:///C:/Users/TedirGhazali/Documents/Plugin/print-web-page/w3.css",      // load an additional css file - load multiple stylesheets with an array []
                pageTitle: "Print My Document",          // add title to print page
                removeInline: false,    // remove all inline styles
                printDelay: 333,        // variable print delay
                         // prefix to html
                footer: null,           // postfix to html
                formValues: true,       // preserve input/form values
                canvas: false,          // copy canvas content (experimental)
                base: false,            // preserve the BASE tag, or accept a string for the URL
                doctypeString: '<!DOCTYPE html>', // html doctype
                removeScripts: false,   // remove script tags before appending
                copyTagClasses: false   // copy classes from the html & body tag
            });
        })
    </script>
</body>
</html>