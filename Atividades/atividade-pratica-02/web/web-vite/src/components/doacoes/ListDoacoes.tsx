import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import api from "../../services/api";

export interface DoacoesInterface {
    id: number;
    data: string;
    pessoa_id: number;
    local_id: number;
    createdAt: string;
    updatedAt: string;
}

const ListDoacoes = () => {

    const [doacoes, setDoacoes] = useState<DoacoesInterface[]>([]);

    useEffect(() => {
        api.get('/doacoes')
            .then(response => setDoacoes(response.data))
    },[]);

    const handleDeleteDoacoes = async (id: number) => {
        if(!window.confirm("Deseja realmente excluir esta doacão?")) {return;}
        try {
            await api.delete('/doacoes',{
                data : {id}
        
            });
            alert("Doação excluida com sucesso!");
            setDoacoes(doacoes.filter(doacoes => doacoes.id !== id)); 
        } catch (error) {
            console.error(error);
            alert("Erro ao excluir doação!")
        }
    }


    return(
        <div>
            <h3>Lista de Doações </h3>
            <div>
            <Link to="/doacoes/create">Cadastrar</Link>
            </div>
            <div>
            <Link to="/">Voltar</Link>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Pessoa</th>
                        <th>Local</th>
                        <th>Data de Criação</th>
                        <th>Data de Atualização</th>
                        <th>Atualizar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>

                    
                
                {
                    doacoes.map(doacoes => (
                        <tr>
                        <td>[{doacoes.id}]</td> 
                        <td>{doacoes.data}</td> 
                        <td>{doacoes.pessoa_id}</td>
                        <td>{doacoes.local_id}</td>
                        <td>{doacoes.createdAt}</td> 
                        <td>{doacoes.updatedAt}</td> 
                        <td><Link to={'/doacoes/update/'+doacoes.id}> Atualizar</Link></td>
                        <td><button onClick={() =>handleDeleteDoacoes(doacoes.id)}>Excluir</button></td>
                        </tr>
                    ))}
                    
                </tbody>
            </table>
        </div>
    );

}

export default ListDoacoes;