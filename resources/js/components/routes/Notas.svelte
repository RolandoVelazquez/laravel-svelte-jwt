<script>
    import {onMount} from 'svelte';
    import axios from 'axios'
    import {infoUser} from '../stores/user';
    let notas;
    onMount(()=>{
        axios.get(`/api/notas`,{
            headers:{
                Authorization:`Bearer ${localStorage.token}`
            }
        }).then(res=>{
            $infoUser.notaAgregada = false;
            notas = res.data
        })
    });
</script>
<h1>Notas</h1>
{#if notas}
    {#each notas as nota}
        <p>{nota.nota}</p>
        <hr>
    {/each}
{/if}
