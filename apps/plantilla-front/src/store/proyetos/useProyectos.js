import {defineStore} from 'pinia'
import {proyectos} from '../../services/proyectos/proyectos.service.js'

export const useProyectosStore = defineStore('proyectos',{
    state:()=>({
        proyectos:[],
        pagination:{},
    }),
    actions:{
        async getProyectos(){
            try {
                const response = await proyectos();
                console.log(response);
                
                this.proyectos = response.data.data;
                this.pagination = response.data.pagination;
                return response.status;
            } catch (error) {
                console.log(error);
                
            }
        }
    }
})