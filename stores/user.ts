import {defineStore} from "pinia";

export const useUserStore = defineStore('userStore', {
    state: () => {
        return {
            hash: '',
            nickname: ''
        }
    },
    persist: {
        storage: piniaPluginPersistedstate.localStorage(),
    },
})
