import { useState } from "react";
import { useNavigate } from "react-router";
import api from "../../services/api";

const CreateLocais = () => {
  const [nome, setNome] = useState<string>("");
  const [rua, setRua] = useState<string>("");
  const [numero, setNumero] = useState<string>("");
  const [complemento, setComplemento] = useState<string>("");
  const [cidade_id, setCidade_id] = useState<number>(0);
  const navigate = useNavigate();

  const handleNewLocal = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const data = {
      nome,
      rua,
      numero,
      complemento,
      cidade_id,
    };

    try {
      await api.post("/locais", data);
      alert("Local de coleta cadastrado com sucesso!");
      navigate("/locais");
    } catch (error) {
      console.error(error);
      alert("Erro ao cadastrar local de coleta!");
    }
  };
  return (
    <div>
      <h2>
        Cadastro de Locais de coleta: {nome} - {rua} - {numero} - {complemento} - {cidade_id}
      </h2>
      <form onSubmit={handleNewLocal}>
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
                    <label htmlFor="cidade_id">ID da Cidade</label>
                    
                    <select name="cidade_id" id="cidade_id"  value={cidade_id} onChange={e => setCidade_id(parseInt(e.target.value))}>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

        <button type="submit">Cadastrar</button>
        <button type="reset">Limpar</button>
      </form>
    </div>
  );
};
export default CreateLocais;
