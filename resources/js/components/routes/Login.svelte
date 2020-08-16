<script>
    import {onMount} from 'svelte';
    import axios from 'axios';
    import {Textfield, Button, Icon} from 'svelte-mui';

    import {userLogin} from '../stores/user';
    import {infoUser} from '../stores/user';

    let credenciales = {
        email: '',
        password: ''
    }
    let errors = {
        email: '',
        password: ''
    }
    let mounted = false;
    onMount(() => {
        let token = localStorage.getItem('token');
        if (!token) {
            $userLogin = false;
            return;
        }
        $userLogin = true;
        mounted = true;
        window.location.href = window.location.origin+'/';
    });

    function login() {
        axios.post(`/api/login`, credenciales).then(res => {
            localStorage.setItem('token', res.data.token);
            $userLogin = true;
            window.location.href = window.location.origin+'/';
        }).catch(error => {
            if (error.response.status === 400) {
                errors.password = 'Verifica tus credenciales'
                errors.email = 'Verifica tus credenciales'
                credenciales.password = '';
                credenciales.email = '';
            }
        });
    }
</script>
<style>
    .form {
        position: absolute;
        top: 50%;
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

{#if !$userLogin}
    <h1>Inicia Sesión</h1>
{:else}
    <h1>Sesion Iniciada</h1>
{/if}

{#if !$userLogin}
    <section class="form animated flipInX">
        <h2>Inicia sesión para continuar</h2>
        <form on:submit|preventDefault={login} class="loginbox" autocomplete="off">
            <Textfield error="{errors.email}" autocomplete="off" type="email" label="Correo Electronico" required
                       bind:value={credenciales.email} message="Ingresa tu correo"/>
            <Textfield error="{errors.password}" autocomplete="off" type="password" label="Contraseña" required
                       bind:value={credenciales.password}
                       message="Ingresa tu Contraseña"/>
            <br>
            <Button color='#00796b'>
                Iniciar Sesión
                <Icon path="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" style="margin: 0 -4px 0 8px;"/>
            </Button>
        </form>
    </section>
{/if}
