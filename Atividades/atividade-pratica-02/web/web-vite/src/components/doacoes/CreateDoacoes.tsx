import { useEffect, useState } from "react";
import { useNavigate } from "react-router";
import api from "../../services/api";
import { PessoasInterface } from "../pessoas/ListPessoas";
import { LocaisInterface } from "../locais/ListLocais";

const CreateDoacoes = () => {
  const [date, setData] = useState<Date>(new Date());

  const [pessoa_id, setPessoa_Id] = useState<number>(0);
    const[pessoa, setPessoa] = useState<PessoasInterface[]>([]);
    const [local_id, setLocal_Id] = useState<number>(0);
    const[local, setLocal] = useState<LocaisInterface[]>([]);

    useEffect(() => {
        api.get('/pessoas')
            .then(response => setPessoa(response.data))
    },[]);
    useEffect(() => {
        api.get('/locais')
            .then(response => setLocal(response.data))
    },[]);

  const navigate = useNavigate();
  

  const handleNewDoacoes = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const data = {
      date,
        pessoa_id: parseInt(String(pessoa_id)),
        local_id: parseInt(String(local_id)),
    };

    try {
      await api.post("/doacoes", data);
      alert("Doacão cadastrada com sucesso!");
      navigate("/doacoes");
    } catch (error) {
      console.error(error);
      alert("Erro ao cadastrar doacão!");
    }
  };
  return (
    <div>
        <h2>Cadastro de Doações</h2>
      <form onSubmit={handleNewDoacoes}>
        <div>
          <label htmlFor="date">Data: </label>
          <input
            type="date"
            name="data"
            id="data"
            value={date.toString()}
            placeholder="Data da doação"
            onChange={(e) => setData(new Date(e.target.value))}
          />
        </div>

                <div>
                    <label htmlFor="pessoa_id">ID da pessoa</label>
                    
                    <select name="pessoa_id" id="pessoa_id"  value={pessoa_id} onChange={e => setPessoa_Id(parseInt(e.target.value))}>
                        <option value="0" selected>Selecione</option>
                        {
                            pessoa.map(pessoa => (
                                <option key={pessoa.id} value={pessoa.id}>{pessoa.nome}</option>
                            ))

                        }
                    </select>
                </div>
                <div>
                    <label htmlFor="local_id">ID do local</label>
                    
                    <select name="local_id" id="local_id"  value={local_id} onChange={e => setLocal_Id(parseInt(e.target.value))}>
                        <option value="0" selected>Selecione</option>
                        {
                            local.map(local => (
                                <option key={local.id} value={local.id}>{local.nome}</option>
                            ))

                        }
                    </select>
                </div>

        <button type="submit">Cadastrar</button>
        <button type="reset">Limpar</button>
      </form>
    </div>
  );
};
export default CreateDoacoes;
