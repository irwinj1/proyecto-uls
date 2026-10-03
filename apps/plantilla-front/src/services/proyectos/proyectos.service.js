import api from '../../utils/axios'
const proyectos = async()=> await api.get('proyectos')

export {
    proyectos
}