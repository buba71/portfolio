import truncate from "../../assets/utils/filters.js";

describe('check filters', () => {

    it('Should return only 60 characters', () => {
        const stringTest = `Je suis une chaine de caractères contenant plus de 60 caractères. Si le test échoue, cela signifira que ma fonction truncate ne fonctionne pas`;

        expect(truncate(stringTest).length).toBeLessThanOrEqual(60);
    })
});