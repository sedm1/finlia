type BaseData = {
    text: string,
}

type Errors = {
    text: string
}

export type Api<T = {}> = {
    data: BaseData & T,
    errors: Errors
}
