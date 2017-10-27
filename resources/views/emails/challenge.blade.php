<center>
    <table border="0" width="100%"
           style="max-width: 640px; font-size: 14px; font-family: 'Helvetica Neue', helvetica,sans-serif">
        <tr>
            <td>
                <div style="background: #2196f3; color: white; clear: both; padding: 10px 15px; height: 25px; border-bottom: solid 1px white;">
                    <div style="
                        float: left;
                        font-size: 20px;
                        font-weight: normal;
                        text-align: left;">Random 2
                    </div>
                    <div style="
                        float: right;
                        font-size: 16px;
                        font-weight: 300;
                        padding-top: 5px">Asignación de Tarea
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="color: #666; text-align: right; font-size: 11px; padding-top: 15px; padding-right: 15px;">
                    Fecha: {{\Carbon\Carbon::now()}}</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="color: #474747; padding: 25px 50px;">
                    <p><strong>Hola {{ $user->name }},</strong></p>

                    <p style="font-size: 13px; line-height: 21px;">
                       <span> Random App te ha asignado la siguiente tarea: <strong>{{ $challenge->task }}. </strong> para el
                        día: <strong>{{ $challenge->created_at->toCookieString() }} </strong></span>
                    </p>
                    <br/>

                    <p style="font-size: 11px; color: #666;">
                        Gracias. - El equipo de Random App
                    </p>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div style="color: #424242; border-bottom: solid 1px #2196f3; font-size: 11px;text-align:center; padding: 10px 5px;">
                    <div style="padding: 5px 0">©2017 Daniel Pérez Atanacio</div>
                    <a style="color: #424242; text-decoration: none;" href="http://random.pagelab.io/">http://random.pagelab.io/</a>
                </div>
            </td>
        </tr>
    </table>

</center>