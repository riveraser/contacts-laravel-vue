<template>
    <div class="h-screen bg-white">
        <div class="flex" >
            <div class="pl-6 bg-gray-200 w-48 h-screen border-r-2 border-gray-300 " >
                <nav class="pt-4">
                    <router-link to="/contacts" ><img src="/img/iconoSR32.png" alt="SR" width="32" class="shadow inline-block" ></router-link>

                    <p class="text-gray-500 uppercase  text-xs pt-10" >Create</p>
                    <router-link to="/contacts/create" class="flex items-center py-2 hover:text-blue-600 hover:bg-gray-200" >
                        <svg class="fill-current text-blue-600 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
                        <div class="tracking-wide pl-3 text-sm font-bold" >Add New</div>
                    </router-link>

                    <p class="text-gray-500 uppercase  text-xs pt-10" >General</p>
                    <router-link to="/contacts" class="flex items-center py-2 hover:text-blue-600 hover:bg-gray-200" >
                        <svg class="fill-current text-blue-600 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg>
                        <div class="tracking-wide pl-3 text-sm font-bold" >Contacts</div>
                    </router-link>
                    <router-link to="/birthdays" class="flex items-center py-2 hover:text-blue-600 hover:bg-gray-200" >
                        <svg class="fill-current text-blue-600 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.83 4H20v6h-1v10H1V10H0V4h5.17A3 3 0 0 1 10 .76 3 3 0 0 1 14.83 4zM8 10H3v8h5v-8zm4 0v8h5v-8h-5zM8 6H2v2h6V6zm4 0v2h6V6h-6zM8 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm4 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
                        <div class="tracking-wide pl-3 text-sm font-bold" >Birthdays</div>
                    </router-link>

                    <p class="text-gray-500 uppercase  text-xs pt-10" >Settings</p>
                    <router-link to="/" class="flex items-center py-2 hover:text-blue-600 hover:bg-gray-200" >
                        <svg class="fill-current text-blue-600 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" width="22" height="22"><path class="heroicon-ui" d="M19 6.41L8.7 16.71a1 1 0 1 1-1.4-1.42L17.58 5H14a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V6.41zM17 14a1 1 0 0 1 2 0v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h5a1 1 0 0 1 0 2H5v12h12v-5z"/></svg>
                        <div class="tracking-wide pl-3 text-sm font-bold" >Logout</div>
                    </router-link>

                </nav>
            </div>
            <div class="flex flex-col flex-1 h-screen overflow-y-hidden" >
                <div class="h-16 p-6 border-b border-gray-400 flex items-center justify-between bg-gray-100 " >
                    <div>Contacts</div>

                    <div class="flex items-center" >
                        <SearchBar></SearchBar>
                        <UserCircle :name="user.name" ></UserCircle>
                    </div>

                </div>
                <div class="flex flex-col overflow-y-hidden flex-1"  >
                    <router-view class="p-6 overflow-x-hidden" ></router-view>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import SearchBar from './SearchBar';
import UserCircle from './UserCircle';

export default {
    name: "App",
    components: {
        UserCircle,
        SearchBar
    },
    props: [
        'user'
    ],

    created(){
        window.axios.interceptors.request.use( config => {

            if (config.method === 'get'){
                config.url = `${config.url}?api_token=${this.user.api_token}`;
            } else {
                config.data = {
                    ...config.data,
                    api_token: this.user.api_token
                }
            }
            return config;
        });
    }

}
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: all .3s ease-out;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    transform: scaleY(0);
    height: 1px;
    font-size: 1px;
}
.fadeOpacity-enter-active,
.fadeOpacity-leave-active {
  transition: opacity 0.25s ease-out;
}
.fadeOpacity-enter, .fadeOpacity-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
