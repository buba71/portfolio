import postDetails from "../../../assets/store/modules/postDetails";
import axios from "axios";


jest.mock('axios');

describe("Send comment to Api", () => {

    beforeEach(() => {
        axios.post.mockReset();
        axios.post.mockResolvedValue()
    });

    it("Should send a comment to API and update comment state", async() => {

        // Init comment to send.
        const comment = {
            author: 'David',
            content: 'My comment test.',
            post: `/api/pots/100`
        };
        // Mocking Store commit function.
        const commit = jest.fn();

        // Init Response from axios mock with the comment to send.
        const response = {
            data: comment
        };

        // Set the response of axios response mock.
        axios.post.mockResolvedValue(response);

        await postDetails.actions.postComment({commit}, comment);

        expect(axios.post).toBeCalledWith('comments', comment);
        expect(commit).toHaveBeenCalledWith("ADD_COMMENT", comment);
    });
});
