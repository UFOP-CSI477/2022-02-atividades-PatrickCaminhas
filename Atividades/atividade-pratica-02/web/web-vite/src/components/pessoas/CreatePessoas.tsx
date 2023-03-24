import { useEffect, useState } from "react";
import { useNavigate } from "react-router";
import api from "../../services/api";
import { TipoInterface } from "../tipos/ListTipos";

const CreatePessoas = () => {
  const [nome, setNome] = useState<string>("");
  const [rua, setRua] = useState<string>("");
  const [numero, setNumero] = useState<string>("");
  const [complemento, setComplemento] = useState<string>("");
  const [documento, setDocumento] = useState<string>("");
  const [cidade_id, setCidade_id] = useState<number>(0);
  const [tipo_id, setTipo_Id] = useState<number>(0);
    const[tipos, setTipos] = useState<TipoInterface[]>([]);

    useEffect(() => {
        api.get('/tipos')
            .then(response => setTipos(response.data))
    },[]);

  const navigate = useNavigate();
  

  const handleNewPessoas = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const data = {
      nome,
      rua,
      numero,
      complemento,
      documento,
      cidade_id,
        tipo_id: parseInt(String(tipo_id)),
    };

    try {
      await api.post("/pessoas", data);
      alert("Pessoa cadastrada com sucesso!");
      navigate("/pessoas");
    } catch (error) {
      console.error(error);
      alert("Erro ao cadastrar pessoa!");
    }
  };
  return (
    <div>
      <h2>
        Cadastro de Pessoas: {nome} - {rua} - {numero} - {complemento} - {documento} - {cidade_id} - {tipo_id}
      </h2>
      <form onSubmit={handleNewPessoas}>
        <div>
          <label htmlFor="nome">Nome: </label>
          <input
            type="text"
            name="nome"
            id="nome"
            value={nome}
            placeholder="Nome do local de coleta"
            onChange={(e) => setNome(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="rua">Rua: </label>
          <input
            type="text"
            name="rua"
            id="rua"
            value={rua}
            placeholder="Nome da rua"
            onChange={(e) => setRua(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="numero">Numero: </label>
          <input
            type="number"
            name="numero"
            id="numero"
            value={numero}
            placeholder="Numero da rua"
            onChange={(e) => setNumero(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="complemento">Complemento: </label>
          <input
            type="text"
            name="complemento"
            id="complemento"
            value={complemento}
            placeholder="Complemento do endereço"
            onChange={(e) => setComplemento(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="documento">Documento: </label>
          <input
            type="text"
            name="documento"
            id="documento"
            value={documento}
            placeholder="Documento"
            onChange={(e) => setDocumento(e.target.value)}
          />
        </div>
        <div>
                    <label htmlFor="cidade_id">ID da Cidade</label>
                    
                    <select name="cidade_id" id="cidade_id"  value={cidade_id} onChange={e => setCidade_id(parseInt(e.target.value))}>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div>
                    <label htmlFor="tipo_id">ID do Tipo de sangue</label>
                    
                    <select name="tipo_id" id="tipo_id"  value={tipo_id} onChange={e => setTipo_Id(parseInt(e.target.value))}>
                        <option value="0" selected>Selecione</option>
                        {
                            tipos.map(tipo => (
                                <option key={tipo.id} value={tipo.id}>{tipo.tipo} - {tipo.Fator}</option>
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
export default CreatePessoas;
