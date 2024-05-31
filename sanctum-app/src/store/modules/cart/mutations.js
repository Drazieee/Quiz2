import Vuex from 'vuex'
import axios from 'axios'
export const store = new Vuex.Store({
    mutations: {
        async updatePosts(state, posts) {
            await axios.get(state.apiUrl + '/posts')
                .then(response => {
                    posts = response.data;
                })
                .catch(error => {   
                    console.error("Error fetching posts:", error);
                });
            state.posts = posts;
        }
    }
})