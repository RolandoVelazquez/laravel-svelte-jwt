<script>
    import {Textfield, Button, Icon} from 'svelte-mui';
    import axios from 'axios';
    import {onMount} from 'svelte';
    import {userLogin, infoUser} from '../stores/user';
    let nota;
    function guardar(){
//        axios.post(`${window.location.origin}/api/guardarnotas`,{nota:nota},{
        axios.post(`/api/guardarnotas`,{nota:nota},{
            headers:{
                Authorization:`Bearer ${localStorage.token}`
            }
        }).then(res=>{
            $infoUser.notaAgregada = true
            nota = ""
        })
    }
</script>
<h1>Redactar</h1>

    <form on:submit|preventDefault={guardar} class="loginbox" autocomplete="off">
        <Textfield  autocomplete="off"  label="Redacta tu nota" required
                   bind:value={nota} message="Ingresa tu nota"/>
        <br>
        <Button color='#00796b'>
            Guardar
            <Icon path="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" style="margin: 0 -4px 0 8px;"/>
        </Button>
    </form>
