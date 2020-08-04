<script>
    import {onMount} from 'svelte';
    import axios from 'axios';
    import {Textfield, Button, Icon} from 'svelte-mui';
    import {userLogin} from '../stores/user';

    let credenciales = {
        name: '',
        email: '',
        password:'',
        password_confirmation:''
    }
    let errors = {
        name:'',
        email: '',
        password: '',
        password_confirmation:''
    }
    function register() {
        axios.post(`${window.location.origin}/api/register`, credenciales).then(res => {
            localStorage.setItem('token', res.data.token);
            $userLogin = true;
            window.location.href = window.location.origin+'/';
        }).catch(error => {
            if (error.response.status === 400) {
                error.response.data = JSON.parse(error.response.data);
                errors.password = error.response.data.name
                errors.email = error.response.data.email
                errors.password = error.response.data.password;
                errors.password_confirmation = error.response.data.password_confirmation;
                if (error.response.data.password || error.response.data.password_confirmation){
                    credenciales.password = '';
                    credenciales.password_confirmation = '';
                }

            }
        });
    }
</script>
<style>
    .form {
        position: absolute;
        top: 40%;
        left: 50%;
        background: #fff;
        width: 285px;
        margin: -140px 0 0 -182px;
        padding: 40px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    }

    .form h2 {
        margin: 0 0 20px;
        line-height: 1;
        color: black;
        font-size: 18px;
        font-weight: 400;
    }
</style>

<h1>Registrar</h1>
<section class="form animated flipInX">
    <h2>Registrate</h2>
    <form on:submit|preventDefault={register} class="loginbox" autocomplete="off">
        <Textfield error="{errors.nam}" autocomplete="off" type="text" label="Correo Electronico" required
                   bind:value={credenciales.name} message="Ingresa tu nombre"/>
        <Textfield error="{errors.email}" autocomplete="off" type="email" label="Contraseña" required
                   bind:value={credenciales.email}
                   message="Ingresa tu Correo"/>
        <Textfield error="{errors.password}" autocomplete="off" type="password" label="Contraseña" required
                   bind:value={credenciales.password}
                   message="Ingresa tu Contraseña"/>
        <Textfield error="{errors.password_confirmation}" autocomplete="off" type="password" label="Contraseña" required
                   bind:value={credenciales.password_confirmation}
                   message="Confirma tu contraseña"/>
        <br>
        <Button color='#00796b'>
            Registrar
            <Icon path="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" style="margin: 0 -4px 0 8px;"/>
        </Button>
    </form>
</section>
