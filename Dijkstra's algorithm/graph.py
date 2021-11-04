from collections import defaultdict
length = -1


# класс для представления графа
class Graph:
    # конструктор класса: служит для инициализации объекта класса при создании
    def __init__(self):
        self.edges = defaultdict(list)
        self.nodes = []
        self.weights = {}

    # добавление ребра в граф
    def add_edge(self, from_node, to_node, weight):
        self.edges[from_node].append(to_node)
        self.weights[(from_node, to_node)] = weight

    # добавление узла в граф
    def add_node(self, node):
        self.nodes.append(node)

    # получение некоторого узла графа по имени
    def get_node(self, name):
        for e in self.nodes:
            if e.get_name() is name:
                return e

    # очистка графа
    def clear(self):
        self.edges.clear()
        self.nodes.clear()
        self.weights.clear()


# алгоритм Дейкстры для смешанных графов
def algorithm(graph, initial, end):
    global length
    length = -1
    shortest_paths = {initial: (None, 0)}
    current_node = initial
    visited = set()

    while current_node != end:
        visited.add(current_node)
        destinations = graph.edges[current_node]
        weight_to_current_node = shortest_paths[current_node][1]

        for next_node in destinations:
            weight = graph.weights[(current_node,
                                    next_node)]
            weight += weight_to_current_node
            if next_node not in shortest_paths:
                shortest_paths[next_node] = (current_node, weight)
            else:
                current_shortest_weight = shortest_paths[next_node][1]
                if current_shortest_weight > weight:
                    shortest_paths[next_node] = (current_node, weight)

        next_destinations = {node: shortest_paths[node]
                             for node in shortest_paths
                             if node not in visited}
        if not next_destinations:
            return "∞"
        current_node = min(next_destinations,
                           key=lambda k: next_destinations[k][1])

    path = []
    while current_node is not None:
        path.append(current_node)
        next_node = shortest_paths[current_node][0]
        current_node = next_node
    path = path[::-1]
    length_path = list(shortest_paths[end])
    length = length_path[1]
    return path
