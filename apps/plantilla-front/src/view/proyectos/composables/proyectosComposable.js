import {useProyectosStore} from '../../../store/proyetos/useProyectos'
import {computed} from 'vue'
export const useProyectos = ()=>{
    const store = useProyectosStore();
    const proyectos = computed(()=>store.proyectos)
    const pagination = computed(()=>store.pagination)

    const obtenerProyectos = async()=>{
        try {
           const response = await store.getProyectos();
            console.log(response);
            
        } catch (error) {
            console.error(error);
        }
    }

    return {
        proyectos,
        pagination, 
        obtenerProyectos
    }
}