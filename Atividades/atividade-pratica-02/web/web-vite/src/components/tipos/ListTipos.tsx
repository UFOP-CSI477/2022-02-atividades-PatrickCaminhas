import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import api from "../../services/api";

export interface TipoInterface {
    id: number;
    tipo: string;
    Fator: string;
    createdAt: string;
    updatedAt: string;
}

const ListTipos = () => {

    const [tipos, setTipos] = useState<TipoInterface[]>([]);

    useEffect(() => {
        api.get('/tipos')
            .then(response => setTipos(response.data))
    },[]);

    const handleDeleteTipo = async (id: number) => {
        if(!window.confirm("Deseja realmente excluir este tipo sanguineo?")) {return;}
        try {
            await api.delete('/tipos',{
                data : {id}
        
            });
            alert("Tipo sanguineo excluido com sucesso!");
            setTipos(tipos.filter(tipo => tipo.id !== id)); 
        } catch (error) {
            console.error(error);
            alert("Erro ao excluir tipo sanguineo!")
        }
    }


    return(
        <div>
            <h3>Lista de tipos sanguineos</h3>
            <div>
            <Link to="/tipos/create">Cadastrar</Link>
            </div>
            <div>
            <Link to="/">Voltar</Link>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Fator</th>
                        <th>Data de Criação</th>
                        <th>Data de Atualização</th>
                        <th>Atualizar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>

                    
                
                {
                    tipos.map(tipo => (
                        <tr>
                        <td>[{tipo.id}]</td> 
                        <td>{tipo.tipo}</td> 
                        <td>{tipo.Fator}</td> 
                        <td>{tipo.createdAt}</td> 
                        <td>{tipo.updatedAt}</td> 
                        <td><Link to={'/tipos/update/'+tipo.id}> Atualizar</Link></td>
                        <td><button onClick={() =>handleDeleteTipo(tipo.id)}>Excluir</button></td>
                        </tr>
                    ))}
                    
                </tbody>
            </table>
        </div>
    );

}

export default ListTipos;