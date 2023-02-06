<script setup>

  import jwt_decode from 'jwt-decode';

  let connectedUser;
  let roleUser;
  let isAdmin;

  const getConnectedUser = async() => {
    const token = localStorage.getItem("token");
    connectedUser = jwt_decode(token)
    roleUser = connectedUser.roles;
    isAdmin = roleUser.includes('ROLE_ADMIN');
  }

  getConnectedUser();
  
</script>

<template>
  <main>
    <div class="border-r-[1px] h-full h-screen" v-if="!isAdmin">
        <h1 class="text-center text-xl mt-11">BackOffice SPA</h1>
        <div class="drawer-side">
          <label for="my-drawer-2" class="drawer-overlay"></label> 
          <ul class="menu p-4 w-80 bg-base-100 text-base-content mt-11">
            <li class="text-lg"><a>Liste des likes</a></li>
            <li class="text-lg"><a href="/backOffice/review">Noter un utilisateur</a></li>
          </ul>
        </div>
    </div>

    <div class="border-r-[1px] h-full h-screen" v-if="isAdmin">
        <h1 class="text-center text-xl mt-11">BackOffice Admin</h1>
        <div class="drawer-side">
          <label for="my-drawer-2" class="drawer-overlay"></label> 
          <ul class="menu p-4 w-80 bg-base-100 text-base-content mt-11">
            <li class="text-lg"><a href="/backOffice/Admin">Gestion des commentaires</a></li>
          </ul>
        </div>
    </div>
    
  </main>
</template>