import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import api from "../../services/api";

export interface PessoasInterface {
    id: number;
    nome: string;
    rua: string;
    numero: string;
    complemento: string;
    documento: string;
    cidade_id: number;
    tipo_id: number;
    createdAt: string;
    updatedAt: string;
}

const ListPessoas = () => {

    const [pessoas, setPessoas] = useState<PessoasInterface[]>([]);

    useEffect(() => {
        api.get('/pessoas')
            .then(response => setPessoas(response.data))
    },[]);

    const handleDeletePessoas = async (id: number) => {
        if(!window.confirm("Deseja realmente excluir esta pessoa?")) {return;}
        try {
            await api.delete('/pessoas',{
                data : {id}
        
            });
            alert("Pessoa excluida com sucesso!");
            setPessoas(pessoas.filter(pessoas => pessoas.id !== id)); 
        } catch (error) {
            console.error(error);
            alert("Erro ao excluir pessoa!")
        }
    }


    return(
        <div>
            <h3>Lista de pessoas </h3>
            <div>
            <Link to="/pessoas/create">Cadastrar</Link>
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
                        <th>Documento</th>
                        <th>ID da cidade</th>
                        <th>ID do tipo sanguineo</th>
                        <th>Data de Criação</th>
                        <th>Data de Atualização</th>
                        <th>Atualizar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>

                    
                
                {
                    pessoas.map(pessoas => (
                        <tr>
                        <td>[{pessoas.id}]</td> 
                        <td>{pessoas.nome}</td> 
                        <td>{pessoas.rua}</td> 
                        <td>{pessoas.numero}</td>
                        <td>{pessoas.complemento}</td>
                        <td>{pessoas.documento}</td>
                        <td>{pessoas.cidade_id}</td>
                        <td>{pessoas.tipo_id}</td>

                        <td>{pessoas.createdAt}</td> 
                        <td>{pessoas.updatedAt}</td> 
                        <td><Link to={'/pessoas/update/'+pessoas.id}> Atualizar</Link></td>
                        <td><button onClick={() =>handleDeletePessoas(pessoas.id)}>Excluir</button></td>
                        </tr>
                    ))}
                    
                </tbody>
            </table>
        </div>
    );

}

export default ListPessoas;