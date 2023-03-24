import { useState } from "react";
import { useNavigate } from "react-router";
import api from "../../services/api";

const CreateTipos = () => {

    const [tipo, setTipo] = useState<string>('');
    const [Fator, setFator] = useState<string>('');
    const navigate = useNavigate();
  
    const handleNewTipo = async (event : React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
      

        const data = {
            tipo,
            Fator
        };

        try {
           await api.post('/tipos', data);
            alert("Tipo sanguineio cadastrado com sucesso!");
            navigate('/tipos');
        } catch (error) {
            console.error(error);
            alert("Erro ao cadastrar tipo sanguineio!")   
        }
    }
    return(
        <div>
            <h2>Cadastro de Tipo: {tipo} - {Fator}</h2>
            <form onSubmit={handleNewTipo}>
            <div>
                    <label htmlFor="tipo">Tipo</label>
                    <select name="tipo" id="tipo"  value={tipo} onChange={e => setTipo(e.target.value)}>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div>
                    <label htmlFor="Fator">Fator</label>
                    
                    <select name="Fator" id="Fator"  value={Fator} onChange={e => setFator(e.target.value)}>
                        <option value="Positivo">Positivo</option>
                        <option value="Negativo">Negativo</option>
                    </select>
                </div>
                <button type="submit">Cadastrar</button>
                <button type="reset">Limpar</button>
            </form>
            
        </div>
    );
}
export default CreateTipos;