import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import api from "../../services/api";

export interface LocaisInterface {
    id: number;
    nome: string;
    rua: string;
    numero: string;
    complemento: string;
    cidade_id: number;
    createdAt: string;
    updatedAt: string;
}

const ListLocais = () => {

    const [locais, setLocais] = useState<LocaisInterface[]>([]);

    useEffect(() => {
        api.get('/locais')
            .then(response => setLocais(response.data))
    },[]);

    const handleDeleteLocais = async (id: number) => {
        if(!window.confirm("Deseja realmente excluir este local de coleta?")) {return;}
        try {
            await api.delete('/locais',{
                data : {id}
        
            });
            alert("Local de coleta excluido com sucesso!");
            setLocais(locais.filter(locais => locais.id !== id)); 
        } catch (error) {
            console.error(error);
            alert("Erro ao excluir local de coleta!")
        }
    }


    return(
        <div>
            <h3>Lista de locais de coleta</h3>
            <div>
            <Link to="/locais/create">Cadastrar</Link>
            </div>
            <div>
            <Link to="/">Voltar</Link>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Rua</th>
                        <th>Numero</th>
                        <th>Complemento</th>
                        <th>Cidade</th>
                        <th>Data de Criação</th>
                        <th>Data de Atualização</th>
                        <th>Atualizar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>

                    
                
                {
                    locais.map(locais => (
                        <tr>
                        <td>[{locais.id}]</td> 
                        <td>{locais.nome}</td> 
                        <td>{locais.rua}</td> 
                        <td>{locais.numero}</td>
                        <td>{locais.complemento}</td>
                        <td>{locais.cidade_id}</td>
                        <td>{locais.createdAt}</td> 
                        <td>{locais.updatedAt}</td> 
                        <td><Link to={'/locais/update/'+locais.id}> Atualizar</Link></td>
                        <td><button onClick={() =>handleDeleteLocais(locais.id)}>Excluir</button></td>
                        </tr>
                    ))}
                    
                </tbody>
            </table>
        </div>
    );

}

export default ListLocais;