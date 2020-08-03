<script>
    import {Link} from "svelte-routing";
    import axios from 'axios';
    import {onMount} from 'svelte';
    import {userLogin,infoUser} from './stores/user';
    import { Button, Icon } from 'svelte-mui';
    onMount(function (){
        let token = localStorage.getItem('token');
        if (!token) {
            $userLogin = false;
            return;
        }
        $userLogin = true;
    })
    function cerrarSesion(){
        axios.post(`${window.location.origin}/api/logout`,'',{
            headers:{
                Authorization:`Bearer ${localStorage.token}`
            }
        }).then(res=>{
            if(res.data.message == "success"){
                localStorage.removeItem('token');
                $userLogin = false;
                window.location.href = window.location.origin+'/iniciar';
            }
        })

    }
</script>
<style>

    .container {
        padding: 50px;
    }

    .card {
        width: 250px;
        height: 420px;
        background-color: #1E2B32;
        border-radius: 10px 10px;
    }

    .header {
        border-radius: 10px 10px 0px 0px;
        padding: 5px;
        background-color: #2A3942;
    }

    h3 {
        color: #FFFFFF;
        font-family: 'Roboto', sans-serif;
        text-align: center;
    }


    .body li {
        transition: 1s all;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        margin-left: -40px;
        margin-top: 0px;
        color: #fff;
        list-style: none;
        display: block;
        border-top-right-radius: 10px 10px;
        border-bottom-right-radius: 10px 10px;
    }

    li.hover:hover {
        transition: 1s all;
        color: #2f89fc;
        background-color: rgba(42, 56, 65, 0.82);
        border-top-right-radius: 10px 10px;
        border-bottom-right-radius: 10px 10px;
        cursor: pointer;
    }


    .body li ul {
        background: #1E2B32;
        margin-left: 280px;
        margin-top: -38px;
        display: none;
        position: absolute;
        border-top-right-radius: 15px 15px;
        border-bottom-right-radius: 15px 15px;
    }


</style>

<div class="container">
    <div class="card">
        <div class="header">
            <h3>Laravel - Svelte - Jwt</h3>
        </div>
        <div class="body">
                <ul id="nav">
                    <li class="hover">
                        <Link to="/">Home</Link>
                    </li>
                    {#if $userLogin}
                        <li class="hover">
                            <Link to="/notas">Ver Notas
                                {#if $infoUser.notaAgregada}
                                    <span style="color: red">*</span>
                                {/if}
                            </Link>
                        </li>
                        <li class="hover">
                            <Link to="/redactar">Redactar Nota</Link>
                        </li>
                        <li style="text-align: center">
                            <Button color="primary" title="Simple button" on:click={cerrarSesion}>Cerrar Sesión</Button>
                        </li>
                    {:else}
                        <li class="hover">
                            <Link to="/iniciar">Login</Link>
                        </li>
                        <li class="hover">
                            <Link to="/registrar">Registro</Link>
                        </li>
                    {/if}

                </ul>
        </div>
    </div>
</div>
