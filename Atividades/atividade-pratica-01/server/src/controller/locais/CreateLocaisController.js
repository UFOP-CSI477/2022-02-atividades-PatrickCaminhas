import { prisma } from "../../database/client.js";
export class CreateLocaisController {
    async handle(request, response) {
        const {nome, rua, numero, complemento, cidade_id } = request.body;
        const local = await prisma.locais.create({
            data: {
                nome: nome,
                rua: rua,
                numero: numero,
                complemento: complemento,
                cidade_id: parseInt(cidade_id)
            }
        });
        return response.json(local);
    }
}